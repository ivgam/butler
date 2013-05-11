<?php

class Fw_Acl {

    public static function getUserType() {
        $oUser = Fw_Register::getRef('user');
        switch ($oUser['usertype']) {
            case 'admin':return 'admin';
            case 'guest':return 'online';
            default: return 'guest';
        }
    }

    public static function parseAcl($acl) {
        foreach ($acl['roles'] as $role => $parent) {
            $res[$role] = (isset($res[$parent])) ? $res[$parent] : array();
            foreach ($acl[$role] as $chain => $permission) {
                list($role, $resource, $task) = explode('.', $chain);
                if (in_array($resource, array_keys($acl['resources']))) {
                    foreach ($acl['subresources'] as $subresource => $parent_resource) {
                        if ($parent_resource == $resource) {
                            $res[$role][$subresource][$task] = $permission;
                        }
                    }
                } else {
                    $res[$role][$resource][$task] = $permission;
                }
            }
        }
        return $res;
    }

    public static function checkAccess($user, $controller, $task) {
        $acl = Fw_Register::getRef('acl');
        $role = self::getUserType($user);
        //By default, the access is denied
        $acl[$role][$controller][$task] = (!isset($acl[$role][$controller][$task])) ? 'deny' : $acl[$role][$controller][$task];
        $acl[$role][$controller]['all'] = (!isset($acl[$role][$controller]['all'])) ? 'deny' : $acl[$role][$controller]['all'];
        if ($acl[$role][$controller][$task] == 'allow' || $acl[$role][$controller]['all'] == 'allow') {
            $to_return = 'WP';
        } else {
            $to_return = 'WOP';
        }
        $to_return = ($role == 'guest') ? 'NL' . $to_return : 'L' . $to_return;
        return $to_return;
    }

}

?>