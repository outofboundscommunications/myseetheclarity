									<div class="pull-right">
										<ul class="">
											<li class="top-tool top-tool-search">
												<form role="search" method="get" class="search-form searchbox" action="<?php echo home_url( '/' ); ?>">
													<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:" onkeyup="buttonUp();" />
													<button type="submit" class="search-submit" value="Search" /><span class="fa fa-search"></span></button>
													<span class="searchbox-icon" style="display: block;">
														<span class="fa fa-search"></span>
													</span>
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
												<a href="#" type="button" class="btn btn-link">
													<span class="top-tool-label">Get Help</span>
												</a>
											</li>
											<li class="top-tool top-tool-locations">
												<a href="#" type="button" class="btn btn-link">
													<span class="top-tool-label">Locations</span>
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