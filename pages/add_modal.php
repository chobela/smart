<!-- Add New -->
<?php	
	
	$sql = "SELECT * FROM services";
	
 $res = mysqli_query($db,$sql);
 
?>
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel"></h4></center>
                </div>
                <div class="modal-body">
				<div class="container-fluid">
				<form method="POST" action="addnew.php">



					<div class="row">

<input type="hidden" class="form-control" name="uid" value="<?=$uiid?>">
<input type="hidden" class="form-control" name="transaction_id" value="ESY<?=$trans?>">
<input type="hidden" class="form-control" name="person" value="<?=$name?>">


						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Service:</label>
						</div>
						<div class="col-lg-10">
							       <select class="form-control select2" id="service" name="service" style="width: 100%;">
                   <option selected="selected" style="position:relative; top:7px;">Select Service Type</option>
                 
						<?php 
					
						foreach($res as $r) { 
							echo "<option value=\"$r[id]\">$r[service]</option>" ;
						}
					        ?>
                </select>
						</div>
					</div>


<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Account #:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="account">
						</div>
					</div>

			<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Amount:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="amount">
						</div>
					</div>




<div style="height:10px;"></div>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label" style="position:relative; top:7px;">Desc:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" name="description">
						</div>
					</div>


<div style="height:10px;"></div>


					
					
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
				</form>
                </div>
				
            </div>
        </div>
    </div>
