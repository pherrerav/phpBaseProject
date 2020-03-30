<?php
if ( !isset($paginas)) {
 echo json_encode(array("paginaId" => "","paginaNombre" => ""));
}else{
	echo '<div>';
echo '<table id="tablaPaginas" class="table  table-bordered table-hover manatenimientos">
    	<thead>
    		<tr>
	    		<th>Paginas</th>
	    		<th>Dar Acceso</th>
    		</tr>
    	</thead>
      <tbody>';
foreach($paginas as $row) {
 echo '<tr>
 			<td>
 				'.$row["paginaNombre"].'
 			</td>	
 			<td>
				<input class="ace ace-switch ace-switch-6" type="checkbox" id="'.$row["paginaId"].'"/>
				<span class="lbl"></span>
 			</td>
    	</tr>
	';
}
echo "</tbody>
	</table>
</div>	";
}
