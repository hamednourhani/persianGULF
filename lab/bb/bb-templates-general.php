<?php 
/*
***********************************************
* General Templates for Backbone.MarionetteJS *
***********************************************
*/

 $ajax_param_nonce = wp_create_nonce("persianGULF_param_helper_nonce");
 $ajax_permalink_nonce = wp_create_nonce("persianGULF_permalink_helper_nonce");
 $ajax_url = admin_url('admin-ajax.php');

 ?>
	 
	

	<script id="main-layout" type="text/template">
	  <section>
	    <navigation id="menu">...</navigation>
	    <article id="content">...</article>
	  </section>
	</script>

	<script type="text/template" id="article-excerpt">
	    
	        <header class="post-title">
	            <h3>
	            	<a class="post-link" href='<%= link %>'><%= title %></a>
	            </h3>
	        </header><!-- post-title -->
	        <div class="post-content">
	            <%= excerpt %>
	        </div><!-- post-content -->
	        <footer class="post-detail">
	           <ul class = "meta-list" >
		            <li>
		            	<a href="<%= author.URL %>" class="data-author author-link p-author h-card" data-author-id="<%= author.ID %>">
		            		<% if(author.name){ print(author.nickname) }else{ print(author.username)} %>
		            	</a> 
		            </li>
		            <li>
		            	<a href="<%= link %>" class="data-date meta-date dt-published">
		            		<% print(date.split("T")[0]) %>
		            	</a>
		            </li>
		            
		            <% if(terms.category){ %>
		            <li> 
		            	<ul>
		            		<% _.each(terms.category,function(cat){ %>
		            			<li>
		            				<a href="<%= cat.link %>" class="data-cat" data-cat="<%= cat.slug %>"><%= cat.name %></a>
		            			</li>
	            			<% },this); %>
		            	</ul>
		            </li> 
		            <% }%>
		            
		            <% if(terms.post_tag){ %>
		            <li>99+
		            	<ul>
		            		 <% _.each(terms.post_tag,function(tag){ %>
		            			<li>
		            				<a href="<%= tag.link %>" class="data-tag" data-tag="<%= tag.slug %>"><%= tag.name %></a>
		            			</li>
	            			<% },this);%>
		            	</ul> 
		            </li>  
		            <% }%>
		            
		            <li>
		            	<a href="#" class="data-comment" data-comment="<%= comment_status %>">comments</a>
		            </li>
		       </ul> 
	        </footer><!-- post-detail -->
	    
	    

	 </script> <!-- #article-excerpt -->

	 <script type="text/template" id="article-content">
	    
	        <header class="post-title">
	            <h1>
	            	<%= title %>
	            </h1>
	        </header><!-- post-title -->
	        <div class="post-content">
	            <%= content %>
	        </div><!-- post-content -->
	         <footer class="post-detail">
	           <ul class = "meta-list" >
		            <li>
		            	<a href="<%= author.URL %>" class="data-author author-link p-author h-card" data-author-id="<%= author.ID %>">
		            		<% if(author.name){ print(author.nickname) }else{ print(author.username)} %>
		            	</a> 
		            </li>
		            <li>
		            	<a href="<%= link %>" class="data-date meta-date dt-published">
		            		<% print(date.split("T")[0]) %>
		            	</a>
		            </li>
		            
		            <% if(terms.category){ %>
		            <li> 
		            	<ul>
		            		<% _.each(terms.category,function(cat){ %>
		            			<li>
		            				<a href="<%= cat.link %>" class="data-cat" data-cat="<%= cat.slug %>"><%= cat.name %></a>
		            			</li>
	            			<% },this); %>
		            	</ul>
		            </li> 
		            <% }%>
		            
		            <% if(terms.post_tag){ %>
		            <li>99+
		            	<ul>
		            		 <% _.each(terms.post_tag,function(tag){ %>
		            			<li>
		            				<a href="<%= tag.link %>" class="data-tag" data-tag="<%= tag.slug %>"><%= tag.name %></a>
		            			</li>
	            			<% },this);%>
		            	</ul> 
		            </li>  
		            <% }%>
		            
		            <li>
		            	<a href="#" class="data-comment" data-comment="<%= comment_status %>">comments</a>
		            </li>
		       </ul> 
	        </footer><!-- post-detail -->
	    

	 </script> <!-- #article-content -->

	 <script type="text/template" id="article-404">
	    
	        <header class="post-title">
	            <h3>
	            	404 not found
	            </h3>
	        </header><!-- post-title -->
	 </script> <!-- #article-404 -->

	 <script type="text/template" id="loading-view">
	   
	   	<h3>
	   		Loading...
	   		<i id="spinner" class="fa fa-cog fa-spin" ></i>
	   	</h3>
	   	
	   	   
 	</script><!-- loading-view -->
 	
 	<script type="text/template" id="empty-area">  	
 	</script><!-- loading-view -->

 	 <script type="text/template" id="comment-template">
	    
	        <div class="post-content">
	            <%= content %>
	        </div><!-- post-content -->
	         <footer class="post-detail">
	           <ul class = "meta-list" >
		            <li>
		            	<a href="<%= author.URL %>" class="data-author author-link p-author h-card" data-author-id="<%= author.ID %>">
		            		<% if(author.name){ print(author.nickname) }else{ print(author.username)} %>
		            	</a> 
		            </li>
		            <li>
		            	<% print(date.split("T")[0]) %>
		            </li>
		            		            
		       </ul> 
	        </footer><!-- post-detail -->
	    

	 </script> <!-- #article-content -->

	 <script type="text/template" id="no-comment-found">
	    
	        <header class="comment-area-title">
	            <h3>
	            	No comment Found
	            </h3>
	        </header><!-- post-title -->
	 </script> <!-- #article-404 -->

	

 	<span id="ajax-param-helper" data-nonce="<?php echo $ajax_param_nonce; ?>" data-url="<?php echo esc_url($ajax_url); ?>"></span>
 	<span id="ajax-permalink-helper" data-nonce="<?php echo $ajax_permalink_nonce; ?>" data-url="<?php echo esc_url($ajax_url); ?>"></span>
 	
	



<?php 
/*
* END of Templates *
*/ 
?>