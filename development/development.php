 <?php /* */ ?>
 
        <?php
        
        global $wp,$wp_rewrite; ?>
        
         <?php 
         	$_SERVER['REQUEST_URI'] = '/wordpress/markup-html-tags-and-formatting/';
         	//$_SERVER['PHP_SELF'] = 'index.php';
			$req_uri = $_SERVER['REQUEST_URI']; 
			$self = $_SERVER['PHP_SELF']; 
        
            $wp->parse_request();
            $query_vars = $wp->query_vars;
            
         ?>
         

        
		<script>
			console.log('REQUEST_URI :'+'<?php echo $req_uri; ?>');
			console.log('PHP_SELF : '+'<?php echo $self; ?>');
			console.log('query_vars :'+ '<?php echo json_encode($query_vars);?>');
			console.log('did_permalink :'+'<?php print_r($wp->did_permalink); ?>');
		</script>
        
<?php


?>