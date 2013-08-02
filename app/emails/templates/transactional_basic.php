<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta property="og:title" content="#SUBJECT#" />
        <title>#SUBJECT#</title>
	</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="margin:0; padding:0;width:100% !important;background-color:#1B1B1B;-webkit-text-size-adjust:none;">
		<center>
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="background-color:#1B1B1B;height:100% !important; margin:0; padding:0; width:100% !important;">
				<tr>
					<td align="center" valign="top" style="padding-top:20px;border-collapse:collapse;">
						<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateContainer" style="border: 1px solid #DDDDDD;background-color:#FFFFFF;">
							<tr>
								<td align="center" valign="top" style="border-collapse:collapse;">
                                    <!-- // Begin Template Header \\ -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateHeader" style="background-color:#FFFFFF;border-bottom:0;">
                                        <tr>
                                            <td class="headerContent" style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle;">
												<img 
													src="<?= PUBLIC_URI.'logo_black.png'?>" 
													style="border:0; height:auto; line-height:100%; outline:none; text-decoration:none;margin-top:20px;margin-bottom:20px;max-width:600px;height:auto;max-width:600px !important;" 
													id="headerImage campaign-icon"
												/>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Header \\ -->
                                </td>
                            </tr>
							<tr>
								<td align="center" valign="top" style="border-collapse:collapse;">
                                    <!-- // Begin Template Body \\ -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateBody">
										<tr>
                                            <td valign="top" style="border-collapse:collapse;">
                                                <!-- // Begin Module: Standard Content \\ -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top" class="bodyContent" style="background-color:#FFFFFF;border-collapse:collapse;">
                                                            <h3 class="h3" style="text-align:center;color:#202020;display:block;font-family:Arial;font-size:26px;font-weight:bold;line-height:100%;margin-top:0;margin-right:0;margin-bottom:10px;margin-left:0;">#TITLE#</h3>
                                                            <div style="text-align: justify;padding:20px 40px;color:#505050;font-family:Arial;font-size:14px;line-height:150%;">
																#BODY#
                                                            </div>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Standard Content \\ -->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Body \\ -->
                                </td>
                            </tr>
							<tr>
								<td align="center" valign="top" style="border-collapse:collapse;">
                                    <!-- // Begin Template Footer \\ -->
									<table border="0" cellpadding="10" cellspacing="0" width="600" id="templateFooter" style="background-color:#FFFFFF;border-top:0;">
										<tr>
											<td valign="top" class="footerContent" style="border-collapse:collapse;">
                                                <!-- // Begin Module: Transactional Footer \\ -->
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top" style="border-collapse:collapse;">
                                                            <div style="color:#707070;font-family:Arial;font-size:12px;line-height:125%;text-align:center;">
																<em><?= date('Y') ?></em>
																<br />
																<strong>Our mailing address is:</strong>
																<br />
																<a href="mailto:<?= Fw_Register::getConfig('fw_email'); ?>" style="color:#a409ba;font-weight:normal;text-decoration:underline;"><?= Fw_Register::getConfig('fw_email'); ?></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- // End Module: Transactional Footer \\ -->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- // End Template Footer \\ -->
                                </td>
                            </tr>
                        </table>
                        <br />
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>