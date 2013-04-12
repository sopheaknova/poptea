<?php global $smof_data; ?>

<footer class="container" id="footer">
<?php if($smof_data['footer_text'] !== '') :
  	echo '<p>' . $smof_data['footer_text'] . '</p>'; 
	else: ?>  
	<p>© <?php echo date('Y'); ?> Popteacambodia.com.</p>
<?php endif;  ?>  
</footer>

<?php echo $smof_data['google_analytics']; ?>

<?php wp_footer(); ?>

</body>
</html>