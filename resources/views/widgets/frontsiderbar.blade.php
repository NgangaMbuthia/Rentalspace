	<div class="widget">
    <h3 class="widgettitle">Best Agents</h3>

    
      <?php foreach($models as $model):?>
        
        <div class="listing-small">
	<div class="listing-small-inner">
		<div class="listing-small-image">
			<a href="#" style="background-image: url('{{asset('/frontend/assets/img/tmp/agent-4.jpg')}}');">
			</a>
		</div><!-- /.listing-small-image -->

		<div class="listing-small-content">
			<h3><a href="agent-detail.html"><?=$model->user->name;?></a></h3>
			<h4><a href="mailto:info@example.com"><?=$model->user->email;?></a></h4>
		</div><!-- /.listing-small-content -->
	</div><!-- /.listing-small-inner -->
</div><!-- /.listing-small -->
    <?php endforeach;?>
</div><!-- /.widget -->	

       					

			<div class="widget">
			   <h2 class="widgettitle">Contact Information</h2>
		       <table class="contact">
				<tbody>
					<tr>
						<th>Address:</th>
						<td>2300 Moi Avenue<br>Nairobi <br>Kenya<br></td>
					</tr>

					<tr>
						<th>Phone:</th>
						<td>+254 7xxx xxxx</td>
					</tr>

					<tr>
						<th>E-mail:</th>
						<td><a href="info@realestate.com">info@realestate.com</a></td>
					</tr>

					
				</tbody>
			</table>	
		</div><!-- /.widget -->	