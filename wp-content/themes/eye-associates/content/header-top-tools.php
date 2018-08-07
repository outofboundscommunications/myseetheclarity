							         <div class="pull-right">
                                      
										<ul class="">
											<li class="top-tool top-tool-search">
												<form role="search" method="get" class="search-form searchbox" action="<?php echo home_url( '/' ); ?>">
													<button type="submit" class="search-submit" value="Search" />
														<span class="search-submit-inner"><span class="fa fa-search"></span></span>
													</button>
													<input type="search" class="search-txt search-field" placeholder="Search …" value="<?php echo get_search_query(); ?>" name="s" title="Search for:" onkeyup="buttonUp();" />
													<?php /* ?>
													<span class="searchbox-icon" style="display: block;">
														<span class="fa fa-search"></span>
													</span>
													<?php */ ?>
												</form>
											</li>
											<?php /* ?>
											<li class="top-tool top-tool-search2">
												<button value="Search" class="search-submit" type="submit">
													<span class="fa fa-search"></span>
												</button>
											</li>
											<?php */ ?>
											<li class="top-tool top-tool-help">
												<a href="<?php get_help();?>" type="button" class="btn btn-link">
													<span class="top-tool-label"><i>&nbsp;</i>Get Help</span>
												</a>
											</li>
											<li class="top-tool top-tool-locations">
												<a href="<?php top_tool_location();?>" type="button" class="btn btn-link">
													<span class="top-tool-label"><i>&nbsp;</i>Locations</span>
												</a>
											</li>
                                                                                        <li class="top-tool top-tool-locations mobilevisible" style="background-color:#f77745 !important">
												<a href="<?php top_tool_careers();?>" type="button" class="btn btn-link">
													<span class="top-tool-label"><i>&nbsp;</i>Careers</span>
												</a>
											</li>
											<?php /* ?>
											<li class="top-tool top-tool-phone">
												<a href="tel:<?php site_phone();?>" type="button" class="btn btn-link"><span class="top-tool-label"><?php site_phone();?></span></a>
											</li>
											<li class="top-tool top-tool-myacc">
												<a href="<?php my_account();?>"> <span class="fa fa-user"></span><span class="top-tool-label">My Account</span></a></a>
											</li>
											<li class="top-tool top-tool-custc">
												<a href="<?php customer_services();?>"><span class="fa fa-comment-o"></span><span class="top-tool-label">Customer Service</span></a></a>
											</li>
											<li class="top-tool top-tool-cntus">
												<a href="<?php contact_us();?>"><span class="fa fa-mobile"></span><span class="top-tool-label">Contact Us</span></a>
											</li>
											<li class="top-tool top-tool-search dropdown">
												<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="fa fa-search"></span></a>
												<ul style="min-width: 300px;" class="dropdown-menu">
													<li>
														<div class="row">
															<div class="col-md-12">
																<?php get_search_form(); ?>
															</div>
														</div>
													</li>
												</ul>
											</li>
											<?php */ ?>
										</ul>
									</div>
                                    <div class="hamburger-close-wrapper">
                                        <span class="hamburger-close">
                                            <span class="icon-bar top"></span>
                                            <span class="icon-bar middel"></span>
                                            <span class="icon-bar bottom"></span>
                                            <span class="Menu-set">Menu</span>
                                        </span>
                                    </div>
                                    <div id="slicknav_menu_desktop"></div>