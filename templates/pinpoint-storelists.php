<?php
	$sendRequest = array(
	    'access_key' => $pinPointAccessKey,
	    'cmd' => 'store-lists'
	);
	$storeLists = getPinPointLocatorData($sendRequest);

    global $pinPointFullPageURL;

    $pageArr  = explode("?", $pinPointFullPageURL);
    $pageDOMAIN = $pageArr[0];
    $pageQUERY = $pageArr[1];
    $newPageQuery = "";
    $pageQueryArr = explode("&", $pageQUERY);
    for($a = 0; $a < count($pageQueryArr); $a++){
        $pageSubArr = explode("=",$pageQueryArr[$a]);
        if($pageSubArr[0] != "cpage"){
            $newPageQuery .= $pageQueryArr[$a]."&";
        }
    }
    $newPageQuery = rtrim($newPageQuery, "&");

    $newPagefullurl = $pageDOMAIN."?".$newPageQuery;


    $perpagelimit = 15;

    if(sanitize_text_field($_GET['cpage']) && trim(sanitize_text_field($_GET['cpage']))!="" && trim(sanitize_text_field($_GET['cpage']))>0)
    {
        $ipage = trim(sanitize_text_field($_GET['cpage']));
        $istart = ($ipage - 1) * $perpagelimit;
    }else{
        $istart = 0;
    }

    if ($ipage == 0){
        $ipage = 1;
    } 
    $iprev = $ipage - 1;                  
    $inext = $ipage + 1;  

     $totalStores = $storeLists->totalstores;
    $ilastpage = ceil($totalStores/$perpagelimit);
    $lmp1 = $ilastpage - 1;

   $endlist = $istart + $perpagelimit;
    if($endlist > $totalStores){
        $endlist = $totalStores;
    }
?> 
<div>
    <h2>Store Lists</h2>
 <table id="storeliststable" class="table"  style="width:100%">
    <thead>
        <tr>
        	<th>Store Id</th>
            <th>Store Name</th>
            <th>Address</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
    	<?php
    	$storeData = $storeLists->stores; 
    	for($s = $istart; $s < $endlist; $s++){
    		?>
    		<tr <?php if($s % 2 == 0){ ?>bgcolor="#ffffff"<?php }else{ ?>bgcolor="#DFDFDF"<?php } ?>>
    			<td style="text-align: center;"><?php echo $storeData[$s]->store_id; ?></td>
	            <td><?php echo $storeData[$s]->store_title; ?></td>
	            <td><?php echo $storeData[$s]->store_address; ?></td>
	            <td style="text-align: center;">
	            	<a href="<?php echo $newPagefullurl; ?>&spage=editstore&sid=<?php echo $storeData[$s]->store_id; ?>">Edit</a>&nbsp;/&nbsp;<a href="javascript:confirmDeletePinStore('<?php echo $storeData[$s]->store_id; ?>')" class="delaction">Delete</a>
	            </td>
	        </tr>
    		<?php
    	}
    	?>
        <tr>
            <td colspan="4" style="padding:0px;">
                <?php
                $mypagination = pagination($ipage, $iprev, $inext, $ilastpage, $lmp1, $newPagefullurl);
                ?>
                 
                <div  class="text-center pagingarea">
                <?php echo $mypagination; ?>
                </div> 
            </td>
        </tr>
    </tbody>
</table>   
<form name="pinpointstoredelete" method="post"> 
    <input type="hidden" name="pinpoint_cmd" value="pinpoint_deletestore" />
    <input type="hidden" name="pinpoint_storeid" id="pinpoint_storeid" value="" />
</form>
<script>
    function confirmDeletePinStore(delStoreId){
        if(confirm('Are you sure want to delete this Store?\r\nThis action cannot be undone!')){
            document.getElementById('pinpoint_storeid').value = delStoreId;
            document.pinpointstoredelete.submit();
        }
    }
</script>
</div>