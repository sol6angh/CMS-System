
			<form>
			  <div class="row">
			  <div class="col-md-6">
				<h1>Settings</h1>
			  </div>
				<div class="col-md-6">
					<div class="btn-group pull-right">
						<input type="submit" name="submit" id="page_submit" class="btn btn-default" value="Save" />
						<a href="#" class="btn btn-default">Close</a>
				</div>
			  </div>
			</div><!-- /.row -->
			<div class="row">
			<hr>
			</div><!-- /.row -->
				<div class="row">
				<?php echo form_open('admin/settings/edit'); ?>
					<div class="col-lg-12">
						<div class="form-group">
							<label>Site Title</label>
							<input class="form-control" type="text" name="<?php echo $this->global_data['site_title']; ?>" value="<?php echo $this->global_data['site_title']; ?>" />
						</div>
						<div class="form-group">
							<label for="page_body">Site Description</label>
							<textarea class="form-control" type="text" name="site_description" rows="10"><?php echo $this->global_data['site_description']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Jumbotron Heading</label>
							<input class="form-control" type="text" name="jheading" value="<?php echo $this->global_data['jumbotron_heading']; ?>" />
						</div>
						<div class="form-group">
							<label>Jumbotron Text</label>
							<textarea class="form-control" name="jtext" rows="10"><?php echo $this->global_data['jumbotron_text']; ?></textarea>
						</div>
						<div class="form-group">
							<label>Jumbotron Button Text</label>
							<input class="form-control" type="text" name="jbuttontext" value="<?php echo $this->global_data['jumbotron_button_text']; ?>"/>
						</div>	
				</div><!-- /.row -->
			</form>
	  </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/docs.min.js"></script>
  </body>
</html>
