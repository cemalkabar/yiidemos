<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id_tag		</th>
 	
 		<th width="80px">
		      name		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id_tag; ?>
		</td>
       		<td>
			<?php echo $row->name; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
