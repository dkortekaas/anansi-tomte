<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
							<tr>
								<td valign="top">
									<!-- Footer -->
									<table border="0" cellpadding="10" cellspacing="0" width="700" id="template_footer">
										<tr>
											<td valign="top">
												<table border="0" cellpadding="10" cellspacing="0" width="100%">
													<tr>
														<td colspan="2" valign="middle" id="credit">
															<div class="address">
																<p>Met vriendelijke groet,<br/><br/>
																Billy &amp; Sandra<br/>
																<img src="<?php echo get_template_directory_uri()?>/assets/images/anansi-tomte-mail-small.png" width="140" height="48"><br/>
																Trévouxperenlaan 89<br/>
																3452 DT Vleuten<br/>
																<span class="orange">T:</span> <a href="tel:0649889282">06-49889282</a><br/>
																<span class="orange">E:</span> <a href="mailto:info@anansi-tomte.nl">info@anansi-tomte.nl</a><br/>
																<span class="orange">I:</span> <a href="http://www.anansi-tomte.nl">www.anansi-tomte.nl</a>
																</p>
															</div>
															<div>
																<br/>
																<a href="https://www.facebook.com/Anansi-Tomte-355916514770429/"><img src="<?php echo get_template_directory_uri()?>/assets/images/social/facebook.png" width="25" height="25"></a>
																<!--<a href=""><img src="<?php //echo get_template_directory_uri()?>/assets/images/social/twitter.png" width="25" height="25"></a>-->
																<a href="https://nl.pinterest.com/anansitomte/pins/"><img src="<?php echo get_template_directory_uri()?>/assets/images/social/pinterest.png" width="25" height="25"></a>
																<a href="https://www.instagram.com/anansitomte/"><img src="<?php echo get_template_directory_uri()?>/assets/images/social/instagram.png" width="25" height="25"></a>
																<br/><br/>
															</div
																
															<hr/>
															<p>De algemene voorwaarden die van toepassing zijn op elk aanbod van Anansi &amp; Tomte VOF en op elke tot stand gekomen overeenkomst op afstand en/of bestellingen tussen Anansi &amp; Tomte en consument en/of deelnemer, zijn te raadplegen op www.anansi-tomte.nl en worden op aanvraag kosteloos toegezonden.</p>
															<p>De informatie, verzonden met dit e-mailbericht (inclusief bijlagen), is uitsluitend bestemd voor de geadresseerde(n). Gebruik van deze informatie, evenals openbaarmaking, vermenigvuldiging, verspreiding en/of verstrekking aan derden door anderen dan de geadresseerde(n) is onrechtmatig jegens afzender dan wel de derde met betrekking tot wie eventueel gegevens in dit e-mailbericht zijn opgenomen.</p>
															<p>Anansi &amp; Tomte VOF sluit elke aansprakelijkheid uit wanneer informatie in dit e-mailbericht niet correct, onvolledig of niet tijdig overkomt dan wel wordt onderschept of gemanipuleerd door derden of door computerprogramma's die worden gebruikt voor elektronische berichten en het overbrengen van virussen, evenals indien er schade ontstaat ten gevolge van dit e-mailbericht.</p>

															<?php //echo wpautop( wp_kses_post( wptexturize( apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) ) ) ) ); ?>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<!-- End Footer -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
