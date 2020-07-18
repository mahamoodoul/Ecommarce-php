<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Product.php' ?>

<?php include_once '../helpers/FormatData.php' ?>


<?php
$pd = new Product();
$fd = new FormatData();
?>

<?php
if (isset($_GET['delproduct'])) {
	// $id=$_GET['delproduct'];
	$id = preg_replace('/[^-a-zA-Z0-9]/', '', $_GET['delproduct']);
	$delProduct = $pd->delProduct($id);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php
			if(isset($delProduct)){
				echo $delProduct;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No .</th>
						<th width="8%">Name</th>
						<th width="8%"> Category</th>
						<th width="8%"> Brand</th>
						<th width="20%">Details</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$getpd = $pd->getAllProduct();
					$i = 0;
					if ($getpd) {
						while ($result = $getpd->fetch_assoc()) {
							$i++;

					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td> <?php echo $result['productname']; ?></td>
								<td><?php echo $result['catname']; ?></td>
								<td><?php echo $result['name']; ?></td>
								<td>
									<p><?php echo $fd->textShorten($result['body'], 50); ?></p>
								</td>
								<td><?php echo $result['price']; ?></td>
								<td><img height="40px" width="60px" src="<?php echo $result['image']; ?>" alt=""></td>
								<td><?php if ($result['type'] == "0") {
										echo "Featured";
									} else {
										echo "Genarel";
									} ?></td>
								<td><a href="productedit.php?proid=<?php echo $result['productid']; ?>">Edit</a> || <a onclick="return confirm('Are you sure want to delete')" href="?delproduct=<?php echo $result['productid']; ?>">Delete</a></td>
							</tr>

					<?php }
					} ?>

				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>