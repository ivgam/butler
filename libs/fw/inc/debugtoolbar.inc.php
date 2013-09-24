<style>
    #debug-toolbar{
        position:fixed;
        background-color: #ddd;
        width:100%;
        max-height:80%;
        min-height:35px;
        margin:0;
        padding:0;
        color:black;
        font-family: Verdana;
        overflow: auto;
        top:0;
        z-index:9998;
    }
    #debug-toolbar ul.debug{
        margin:0;
        padding:7px 0 0 0;
    }
    #debug-toolbar ul li.debug{
        display:inline-block;
        margin: 0 0 0 15px;
        padding: 0;
    }
    #debug-toolbar .debug-toolbar-section{
        display:none;
    }
    #debug-toolbar li span{
        cursor:pointer;
        padding-left:18px;
        margin-left:15px;
        padding-bottom:3px;
    }
    .information{
		background-color: #ddd;
        padding-right:0;
        width:15px;
        height:18px;		
        padding-left:2px;
        z-index:9999;
        position:fixed;		
        top:0;
    }
    #debug-toolbar{display:none;}
    #debug-toolbar .krumo-footnote{display:none;}
</style>
<script type="text/javascript">
    $(document).ready(function(){		
        $('span.information').click(function(){
            $('#debug-toolbar').toggle();
        });
        $('#debug-toolbar li span').click(function(){			
            var tclass = $(this).attr('class');
            var selector = "#debug-toolbar-"+tclass;
            var visible = $(selector).is(':visible');
            $('.debug-toolbar-section').hide();
            if(!visible){				
                $(selector).show();
                $(selector+' ul')
            }
        });
    });
</script>
<span class="information"><i class="icon icon-info-sign"></i>&nbsp;</span>
<div id="debug-toolbar">	
    <ul class="debug">
        <li class="debug"><span class="queries"><i class="icon icon-random"></i> Queries (<?php echo count(Fw_Register::getRef('query_log')) ?>)</span></li>
        <li class="debug"><span class="memory"><i class="icon icon-hdd"></i> Memory Usage (<?php echo round(memory_get_usage() / (1024 * 1024), 2) . 'MB' ?>)</span></li>
        <li class="debug">
            <span class="errors"><i class="icon icon-remove"></i> Errors (<?php
echo
 ((Fw_Register::getRef('error')) ? count(Fw_Register::getRef('error')) : 0)     +
 ((Fw_Register::getRef('warning')) ? count(Fw_Register::getRef('warning')) : 0) +
 ((Fw_Register::getRef('notice')) ? count(Fw_Register::getRef('notice')) : 0)   +
 ((Fw_Register::getRef('other')) ? count(Fw_Register::getRef('other')) : 0)
?>) 
            </span>
        </li>
        <li class="debug"><span class="headers"><i class="icon icon-align-justify"></i> Headers</span></li>
        <li class="debug"><span class="vars"><i class="icon icon-tags"></i> Vars</span></li>
        <li class="debug"><span class="time"><i class="icon icon-time"></i> Time: <?php echo Fw_Register::getRef('end_time') - Fw_Register::getRef('ini_time') ?>s</span></li>
    </ul>
    <div id="debug-container">
        <div id="debug-toolbar-queries" class="debug-toolbar-section">
<?php Krumo::dump(Fw_Register::getRef('query_log')) ?>
        </div>
        <div id="debug-toolbar-memory" class="debug-toolbar-section">
<?php Krumo::dump(get_included_files()) ?>
        </div>
        <div id="debug-toolbar-errors" class="debug-toolbar-section">
            <?php
            Krumo::dump(array(
                'Error' => Fw_Register::getRef('error'),
                'Warning' => Fw_Register::getRef('warning'),
                'Notice' => Fw_Register::getRef('notice'),
                'Other' => Fw_Register::getRef('other')
            ));
            ?>
        </div>
        <div id="debug-toolbar-headers" class="debug-toolbar-section">
<?php Krumo::dump(getAllHeaders()); ?>
        </div>
        <div id="debug-toolbar-vars" class="debug-toolbar-section">
            <?php
            Krumo::dump(array(
                'Request' => Fw_Filter::$aVars,
                'SERVER' => $_SERVER,
                'SESSION' => $_SESSION,
                'Register' => Fw_Register::$aRefs,
                'Defined' => get_defined_vars(),
                'Constants' => get_defined_constants(true)
            ));
            ?>
        </div>
    </div>	
</div>