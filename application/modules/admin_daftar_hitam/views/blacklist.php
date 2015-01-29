<div class="row">
  <div class="span_full">
    <h2><?= $title ?></h2>
    <h4>Total Penyedia : <?= (is_array($data)?count($data):0) ?></h4>
	<form name="form_blaklist" method="POST" id="form_blaklist" class="navbar-content" onsubmit="return false;">
        <table class="attr borders">
			 <tr>
                <th width="1%"></th>
                <th width="1%">No.</th>
				<th width="20%">ID Penyedia</th>
				<th width="20%">Username</th>
				<th width="20%">Nama</th>
                <th width="10%">NPWP</th>
                <th width="10%">Alamat</th>
             </tr>
          	<?php 
          		if(empty($data)){
					echo '<tr class="record">
							<td class="td-content center" colspan="7">No Data Found</td>
						</tr>';
				}else{
					if(!is_array($data)){
						echo '<tr class="record">
							<td class="td-content center" colspan="7">'.$data.'</td>
						</tr>';
					}else{
		          		$no = 1;
		          		foreach( $data as $key => $value){ ?>
						<tr class="record" id="<?= $value["rkn_id"].'~'.$value["user"].'~'.$value["name"].'~'.$value["rkn_npwp"].'~'.$value["rkn_alamat"] ?>">
							<td class="td-content center"><input type="checkbox" id="choices" name="choices" value="<?= $value["rkn_id"] ?>"/></td>
							<td class="td-content center"><?= $no ?></td>
							<td class="td-content center"><?= $value["rkn_id"] ?></td>
							<td class="td-content"><?= $value["user"] ?></td>
							<td class="td-content"><?= $value["name"] ?></td>
							<td class="td-content center"><?= $value["rkn_npwp"] ?></td>
							<td class="td-content"><?= $value["rkn_alamat"] ?></td>
						</tr>
	            <?php $no++;
	            		}
	            	}
	            } ?>
	            <tr>
	            	<td colspan="7">
	            		<textarea id="rknid" style="width: 100;height: 5000;display: none;"></textarea>
	            	</td>
	            </tr>
         </table>
     </form>
  </div>
</div>
<script>
	$(document).ready(function(){
		 $('#checkAll').click(function () {    
		     $('input:checkbox').prop('checked', this.checked);    
		 });
		 $('.record').click(function(){
		 	
		 	var chk = $(this).attr("id")+';';
		 	$("#rknid").val($("#rknid").val()+chk);
		 });
	});
	function unique(list) {
		var result = [];
		$.each(list, function(i, e) {
			if ($.inArray(e, result) == -1) result.push(e);
		});
		return result;
	}
</script>