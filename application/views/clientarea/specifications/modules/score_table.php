<?php 
              	
           $count = count($rows[0]);
						
			for($i=0;$i<$count;$i++)
						
				{
							
				  echo "<tr>\n";
						
						
				  echo "<td>&nbsp;&nbsp;&nbsp;".ucwords($rows[0][$i])."</td>\n";
						
						
				  echo "<td><span class=\"label label-default audit-".$scores['scores'][$rows[1][$i]]."\">".$scores['scores'][$rows[1][$i]]."</span>&nbsp;&nbsp; out of 4</td>\n";
						
						
				  echo "</tr>\n";
							
				}
				
				echo "<br>\n";
				
				echo anchor('/clientarea/specifications/qa_confirm/'.$site_id.'/'.(isset($unique) ? $unique:NULL), 'Save Quality Audit', array('class' => 'btn btn-success pull-right confirm'));
              			
     ?>