<?php
 header("Content-Type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=$title.xls");
 header("Pragma: no-cache");
 header("Expires: 0");
 ?>
 
 <table border="1" width="100%">
 
      <thead>
 
           <tr> 
                <th>No.KB</th>
                <th>Project Name</th>
                <th>SPBBJ</th>
                <th>RAK</th>
                <th>Contract Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>Project Value</th>
                <th>Segment</th>
                <th>Client Contract</th>
                <th>Partner Name</th>
                <th>Date</th>
           </tr>
 
      </thead>
 
      <tbody> <?php //print_r($datakb); die; ?>
 
           <?php 
                foreach($datakb as $k => $v) { 
                ?>
 
           <tr>
 
                <td><?php echo $v['_source']['number_of_kb']; ?></td>
                <td><?php echo $v['_source']['project_name_kb']; ?></td>
                <td><?php echo $v['_source']['spbbj']; ?></td>
                <td><?php echo $v['_source']['number_of_rack']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($v['_source']['contract_date'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($v['_source']['start_date'])); ?></td>
                <td><?php echo date("d-m-Y", strtotime($v['_source']['end_date'])); ?></td>
                <td><?php echo $v['_source']['other_duration']; ?></td>
                <td><?php echo number_format($v['_source']['project_value'], "0", "", ","); ?></td>
                <td><?php echo $v['_source']['segment']; ?></td>
                <td><?php echo $v['_source']['client_contract']; ?></td>
                <td><?php echo $v['_source']['partner_name']; ?></td>
                <td><?php echo date("d-m-Y H:i:s", strtotime($v['_source']['date'])); ?></td>
 
           </tr>
 
                <?php
                } 
            ?>
 
      </tbody>
 
 </table>