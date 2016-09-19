<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_action( 'admin_menu', 'add_custom_options_for_webservices' );

function add_custom_options_for_webservices(){
    add_submenu_page('options-general.php'
    ,__( 'Custom Options for webservices', 'textdomain' )
    ,'WS Options'
    ,'manage_options'
    ,'webservice-content'
    ,'content_area_for_webservices');
	//$appname, $appname, 'administrator','custompage', 'content_area_for_webservices');
   // remove_menu_page('content_area_for_webservices');
}

add_action( 'admin_init', 'submitted_webservices_content' );
function submitted_webservices_content(){
	if(isset($_POST["submit_fotografia"])){
		unset($_POST["submit_fotografia"]);
		foreach($_POST as $k=>$data){
			if($k!="foto_attachment_ids"){
				update_option( $k, $data );
			}else{
				$nd = explode(",",$data);
				$nd = serialize($nd);
				update_option( $k, $nd );
			}
		}
	}
	if(isset($_POST["submit_tour_virtual"])){
		unset($_POST["submit_tour_virtual"]);
		foreach($_POST as $k=>$data){
			if($k!="tour_attachment_ids"){
				update_option( $k, $data );
			}else{
				$nd = explode(",",$data);
				$nd = serialize($nd);
				update_option( $k, $nd );
			}
		}
	}
	
	if(isset($_POST["submit_asesoria"])){
		unset($_POST["submit_asesoria"]);
		foreach($_POST as $k=>$data){
			update_option( $k, $data );
		}	
	}
	if(isset($_POST["submit_financiamiento"])){
		unset($_POST["submit_financiamiento"]);
		foreach($_POST as $k=>$data){
			update_option( $k, $data );
		}	
	}
}

function content_area_for_webservices()
{
	  if(function_exists( 'wp_enqueue_media' )){
			wp_enqueue_media();
		}else{
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
		}
	?>
    <style type="text/css">
	#custom_4_services input, #custom_4_services textarea{ width:100%;}
	</style>
  <div class="wrap" id="custom_4_services">
    <h1><font><font>Custom Content </font></font></h1>
      <table border="0" width="100%" class="wp-list-table widefat fixed striped pages">
        <tr>
          <td>
                  <form method="post" action="">
                        <table  width="100%">
                          <tr>
                            <td><h1><font><font>Fotografia </font></font></h1></td>
                          </tr>
                          <tr>
                            <td>
                                <table  width="100%">
                                    <tr><td colspan="2"><h3>Informacian</h3></td></tr>
                                    <tr>
                                        <td width="30%">Title</td>
                                        <td><input type="text" name="foto_title" value="<?php echo get_option("foto_title");?>"></td>
                                    </tr>
                                    <tr>
                                        <td width="30%">Description</td>
                                        <td><textarea name="foto_desc"><?php echo get_option("foto_desc");?></textarea></td>
                                    </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <table  width="100%">
                                    <tr><td colspan="2"><h3>Fotos</h3></td></tr>
                                    <tr>
                                        <td width="30%">Add Images</td>
                                        <td>
                                        <?php if(get_option("foto_attachment_ids")!=""){
											$imgidsar = unserialize(get_option("foto_attachment_ids")); 
										}?>
                                        <a href="#" class="custom_media_upload button-primary">Upload</a><br>
                                        <div class="custom_media_image"><?php if(count($imgidsar)>0){foreach($imgidsar as $d){
											?>
											<?php if($d != ''){?>
											<div style="width:90px;float:left;">
											<img width="80" height="80" src="<?php echo wp_get_attachment_thumb_url( $d );?>" alt=""  class="attachment-thumbnail size-thumbnail"/>
											<a href="#" data="<?php echo $d; ?>" class="button-primary foto_remove">remove</a>
											</div>
											<?php } ?>
											<?php
										}}?></div>
                                        <input class="custom_media_id" type="hidden" name="foto_attachment_ids" value="<?php echo implode(",",$imgidsar);?>">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <table  width="100%">
                                    <tr><td colspan="2"><h3>Contacto</h3></td></tr>
                                    <tr>
                                        <td width="30%">Email ID</td>
                                        <td><input type="text" name="foto_email" value="<?php echo get_option("foto_email");?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td><input type="text" name="foto_phone" value="<?php echo get_option("foto_phone");?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Skype</td>
                                        <td><input type="text" name="foto_skype" value="<?php echo get_option("foto_skype");?>"></td>
                                    </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td>
                                <p class="submit">
                                  <font><font class=""><input type="submit" name="submit_fotografia" id="submit" class="button-primary" value="Save Fotografia"></font></font>
                                </p>
                            </td>
                          </tr>
                        </table>
                    </form>
          </td>
          <td width="2%">&nbsp;</td>
          <td>
                  <form method="post" action="">
                    <table  width="100%">
                      <tr>
                        <td><h1><font><font>Tour Virtual </font></font></h1></td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Informacian</h3></td></tr>
                                <tr>
                                    <td width="30%">Title</td>
                                    <td><input type="text" name="tour_title" value="<?php echo get_option("tour_title");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Description</td>
                                    <td><textarea name="tour_desc"><?php echo get_option("tour_desc");?></textarea></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            
                                <table  width="100%">
                                    <tr><td colspan="2"><h3>Fotos</h3></td></tr>
                                    <tr>
                                        <td width="30%">Add Images</td>
                                        <td>
                                        <?php $imgidsar=""; if(get_option("tour_attachment_ids")!=""){
											$imgidsar = unserialize(get_option("tour_attachment_ids")); 
										}?>
                                        <a href="#" class="custom_media_upload_a button-primary">Upload</a><br>
                                        <div class="custom_media_image_a"><?php if(count($imgidsar)>0 && $imgidsar!=""){foreach($imgidsar as $d){
										?>
										<?php if($d != ''){s?>
										<div style="width:90px;float:left;">
										<img width="80" height="80" src="<?php echo wp_get_attachment_thumb_url( $d );?>" alt=""  class="attachment-thumbnail size-thumbnail"/>
										<a href="#" data="<?php echo $d; ?>" class="button-primary tour_remove">remove</a>
										</div>
										<?php }
										}}?></div>
                                        <input class="custom_media_id_a" type="hidden" name="tour_attachment_ids" value="<?php if(count($imgidsar)>0 && $imgidsar!=""){echo implode(",",$imgidsar);}?>">
                                        </td>
                                    </tr>
                                </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Contacto</h3></td></tr>
                                <tr>
                                    <td width="30%">Email ID</td>
                                    <td><input type="text" name="tour_email" value="<?php echo get_option("tour_email");?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" name="tour_phone" value="<?php echo get_option("tour_phone");?>"></td>
                                </tr>
                                <tr>
                                    <td>Skype</td>
                                    <td><input type="text" name="tour_skype" value="<?php echo get_option("tour_skype");?>"></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <p class="submit">
                              <font><font class=""><input type="submit" name="submit_tour_virtual" id="submit" class="button-primary" value="Save Tour Virtual"></font></font>
                            </p>
                        </td>
                      </tr>
                    </table>
                    </form>
          </td>          
        </tr>
        <tr><td><p>&nbsp;</p></td></tr>
        <tr>
          <td>
                  <form method="post" action="">
                    <table  width="100%">
                      <tr>
                        <td><h1><font><font>Asesoria Legal </font></font></h1></td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Informacian</h3></td></tr>
                                <tr>
                                    <td width="30%">Title</td>
                                    <td><input type="text" name="asesoria_title" value="<?php echo get_option("asesoria_title");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Description</td>
                                    <td><textarea name="asesoria_desc"><?php echo get_option("asesoria_desc");?></textarea></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Asesoria</h3></td></tr>
                                <tr>
                                    <td width="30%">Title 1</td>
                                    <td><input type="text" name="asesoria_title1" value="<?php echo get_option("asesoria_title1");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Title 2</td>
                                    <td><input type="text" name="asesoria_title2" value="<?php echo get_option("asesoria_title2");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Title 3</td>
                                    <td><input type="text" name="asesoria_title3" value="<?php echo get_option("asesoria_title3");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Title 4</td>
                                    <td><input type="text" name="asesoria_title4" value="<?php echo get_option("asesoria_title4");?>"></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Contacto</h3></td></tr>
                                <tr>
                                    <td width="30%">Email ID</td>
                                    <td><input type="text" name="asesoria_email" value="<?php echo get_option("asesoria_email");?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" name="asesoria_phone" value="<?php echo get_option("asesoria_phone");?>"></td>
                                </tr>
                                <tr>
                                    <td>Skype</td>
                                    <td><input type="text" name="asesoria_skype" value="<?php echo get_option("asesoria_skype");?>"></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <p class="submit">
                              <font><font class=""><input type="submit" name="submit_asesoria" id="submit" class="button-primary" value="Save Asesoria"></font></font>
                            </p>
                        </td>
                      </tr>
                    </table>
               </form>
          </td>
          <td>&nbsp;</td>
          <td>
                  <form method="post" action="">
                    <table  width="100%">
                      <tr>
                        <td><h1><font><font>Financiamiento</font></font></h1></td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Informacian</h3></td></tr>
                                <tr>
                                    <td width="30%">Title</td>
                                    <td><input type="text" name="financ_title" value="<?php echo get_option("financ_title");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Description</td>
                                    <td><textarea name="financ_desc"><?php echo get_option("financ_desc");?></textarea></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Financiamiento</h3></td></tr>
                                <tr>
                                    <td width="30%">Title</td>
                                    <td><input type="text" name="financ_title2" value="<?php echo get_option("financ_title2");?>"></td>
                                </tr>
                                <tr>
                                    <td width="30%">Description</td>
                                    <td><textarea name="financ_desc2"><?php echo get_option("financ_desc2");?></textarea></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <table  width="100%">
                                <tr><td colspan="2"><h3>Contacto</h3></td></tr>
                                <tr>
                                    <td width="30%">Email ID</td>
                                    <td><input type="text" name="financ_email" value="<?php echo get_option("financ_email");?>"></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><input type="text" name="financ_phone" value="<?php echo get_option("financ_phone");?>"></td>
                                </tr>
                                <tr>
                                    <td>Skype</td>
                                    <td><input type="text" name="financ_skype" value="<?php echo get_option("financ_skype");?>"></td>
                                </tr>
                            </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                            <p class="submit">
                              <font><font class=""><input type="submit" name="submit_financiamiento" id="submit" class="button-primary" value="Save Financiamiento"></font></font>
                            </p>
                        </td>
                      </tr>
                    </table>
              </form>
          </td>
        </tr>
      </table>
    <br class="clear">
  </div>
  
  <script>

   jQuery('.custom_media_upload').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'Add Images',
        button: {
            text: 'Add Images'
        },
        multiple: true  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
		var attachment = custom_uploader.state().get('selection');
		var ids = attachment.map( function (selection) {
			return selection.id;
		});
		var imturl = attachment.map( function( selection ) {
			selection = selection.toJSON();
			return jQuery('.custom_media_image').append('<div style="width:90px;float:left;"><img width="80" height="80" src="'+ selection.sizes.thumbnail.url +'" alt=""  class="attachment-thumbnail size-thumbnail"/><a href="#" data="'+selection.id+'" class="button-primary foto_remove">remove</a></div>');
		});
		var previous_val = jQuery(".custom_media_id").val();
		if(previous_val!=""){previous_val=","+previous_val;}else{previous_val="";}
		jQuery(".custom_media_id").val(ids.join(',')+previous_val);
		imturl.join(' ');
    })
    .open();
});


jQuery('.custom_media_upload_a').click(function(e) {
    e.preventDefault();

    var custom_uploader = wp.media({
        title: 'Add Images',
        button: {
            text: 'Add Images'
        },
        multiple: true  // Set this to true to allow multiple files to be selected
    })
    .on('select', function() {
		var attachment = custom_uploader.state().get('selection');
		var ids = attachment.map( function (selection) {
			return selection.id;
		});
		var imturl = attachment.map( function( selection ) {
			selection = selection.toJSON();
			return jQuery('.custom_media_image_a').append('<div style="width:90px;float:left;"><img width="80" height="80" src="'+ selection.sizes.thumbnail.url +'" alt=""  class="attachment-thumbnail size-thumbnail"/><a href="#" data="'+selection.id+'" class="button-primary tour_remove">remove</a></div>');
		});
		var previous_val = jQuery(".custom_media_id_a").val();
		if(previous_val!=""){previous_val=","+previous_val;}else{previous_val="";}
		jQuery(".custom_media_id_a").val(ids.join(',')+previous_val);
		imturl.join(' ');
    })
    .open();
});

	jQuery(document).on('click','.foto_remove',function(e) {
		e.preventDefault();
		var id  = jQuery(this).attr('data');
		jQuery(this).parent().hide();
		var str = jQuery('.custom_media_id').val();
		var res = str.split(",");
		var index = res.indexOf(id);
		if (index > -1) {
			res.splice(index, 1);
		}
		jQuery('.custom_media_id').val(res.toString());
	});
		
	jQuery(document).on('click','.tour_remove',function(e) {
		e.preventDefault();
		var id  = jQuery(this).attr('data');
		jQuery(this).parent().hide();
		var str = jQuery('.custom_media_id_a').val();
		var res = str.split(",");
		var index = res.indexOf(id);
		if (index > -1) {
			res.splice(index, 1);
		}
		jQuery('.custom_media_id_a').val(res.toString());
	});
    </script>

  <?php
}
?>