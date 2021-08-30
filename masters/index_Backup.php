<?php
include("../include/conFig.php");
?>
<div class="title">Setup</div>
<div class="strip">
<span>Dashboard</span>
<span>Setup</span>
<span>List</span>
</div>

<div style="overflow-x:hidden;overflow-y:scroll;height:500px;">
<!--<div class="head-title"> 
<i class="add-form"></i> 
Masters</div>-->
<table cellpadding="5" cellspacing="5" style="padding-left:50px;font-size:14px !important" align="left" width="50%">
<tr><th colspan="2" style="float:left;color: rgb(112, 112, 201);" > Masters</th></tr>
            	<tr>
			<?php if(in_array('v_MAssets',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/typeofasset/view','viewContent','manipulateContent','Asset')"><i class="master"></i>Asset</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Assets')"><i class="master"></i>Asset</td>
			<?php
			} 
			?>
			<?php if(in_array('v_bra',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/branch/view','viewContent','manipulateContent','Branch')"><i class="master"></i>Branch</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Branch')"><i class="master"></i>Branch</td>
			<?php
			} 
 
			?>
            	</tr>
            	<tr>
            				<?php if(in_array('v_MCheckl',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/checklist/view','viewContent','manipulateContent','Checklist')"><i class="master"></i>Checklist</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer;  text-align:left; width: 142px;" class="link-blue" onclick="permission('Checklist')"><i class="master"></i>Checklist</td>
			<?php
			} 
			?>
			            	
            	
            				<?php if(in_array('v_MDep',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/department/view','viewContent','manipulateContent','Department')"><i class="master"></i>Department</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Department')"><i class="master"></i>Department</td>
			<?php
			} 
			?>
			</tr>
			<tr>
			<?php if(in_array('v_MDesi',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/designation/view','viewContent','manipulateContent','Designation')"><i class="master"></i>Designation</td>
			<?php 
			}
			else
			{
			?>
			
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Designation')"><i class="master"></i>Designation</td>
			<?php
			} 
			?>
            	           	<?php if(in_array('v_MEQues',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/exitquestions/view','viewContent','manipulateContent','Exit Questions')"><i class="master"></i>Exit Questions</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Exit Questions')"><i class="master"></i>Exit Questions</td>
			<?php
			} 
			?>
			</tr>
            	<tr>
			<?php if(in_array('v_MLtype',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/leavetype/view','viewContent','manipulateContent','Leave Type')"><i class="master"></i>Leave Type</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Leave Type')"><i class="master"></i>Leave Type</td>
			<?php
			} 
			?>
            	
           	<?php if(in_array('v_MLoc',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/location/view','viewContent','manipulateContent','Location')"><i class="master"></i>Location</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Location')"><i class="master"></i>Location</td>
			<?php
			} 
			?>
			</tr>
            	<tr>
			<?php if(in_array('v_MEStatus',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/employeestatus/view','viewContent','manipulateContent','Employee Status')"><i class="master"></i>Employee Status</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Employee Status')"><i class="master"></i>Employee Status</td>
			<?php
			} 
			?>            	
            	
           	<?php if(in_array('v_MPFKPI',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/kpiparameters/view','viewContent','manipulateContent','Parameters for KPI')"><i class="master"></i>Parameters for KPI</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Parameters for KPI')"><i class="master"></i>Parameters for KPI</td>
			<?php
			} 
			?>
			</tr>
            	<tr>
			<?php if(in_array('v_MRFLeav',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/reasonforleaving/view','viewContent','manipulateContent','Reason For Leaving')"><i class="master"></i>Reason For Leaving</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Reason For Leaving')"><i class="master"></i>Reason For Leaving</td>
			<?php
			} 
			?>            	
            	           	<?php if(in_array('v_MRelation',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/relationship/view','viewContent','manipulateContent','Relationship')"><i class="master"></i>Relationship</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Relationship')"><i class="master"></i>Relationship</td>
			<?php
			} 
			?>
			</tr>
            	<tr>
			<?php if(in_array('v_MSOHire',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/sourceofhire/view','viewContent','manipulateContent','Source Of Hire')"><i class="master"></i>Source Of Hire</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Reason For Leaving')"><i class="master"></i>Source Of Hire</td>
			<?php
			} 
			?>            	
                        	<?php if(in_array('v_empshift',$thisper)) 
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/shift/view','viewContent','manipulateContent','Shift')"><i class="master"></i>Employee Shift</td>
            	<?php 
			     }
			     else
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Shift')"><i class="master"></i>Employee Shift</td>
			<?php
			} 
			?>            	
				<?php if(in_array('v_edu',$thisper)) 
			     {
			     ?>
			     </tr>
            	<tr>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/education/view','viewContent','manipulateContent','Education')"><i class="master"></i>Education</td>
            	<?php 
			     }
			     else
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Education')"><i class="master"></i>Education</td>
			<?php
			} 
			?>            	
            	
            	            	<?php if(in_array('v_inv',$thisper)) 
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/inventory/view','viewContent','manipulateContent','Inventory')"><i class="master"></i>Inventory</td>
                <?php 
			     }
			     else
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left; width: 142px;" class="link-blue" onclick="permission('Inventory')"><i class="master"></i>Inventory</td>
			<?php
			} 
			?>            	
               </tr>
            	<tr>

<?php if(in_array('v_doc',$thisper)) 
			     {
			     ?>
 
                <td style="cursor:pointer; text-align:left; width: 156px;" class="link-blue" onclick="getModule('masters/document/view','viewContent','manipulateContent','Document')"><i class="master"></i>Document</td>
 <?php 
			     }
			     else
			     {
			     ?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Document')"><i class="master"></i>Document</td>
			<?php
			} 
			?>            	

<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/salaryProfile/view','viewContent','manipulateContent','Document')"><i class="master"></i>Salary Profile</td>
            	</tr>
            	

</table>
<table cellpadding="5" cellspacing="5" width="25%" style="padding-left:50px;font-size:14px !important">
<tr>
            	<th colspan="2" style="float:left;color: rgb(112, 112, 201);">Manage Profile</th>
            	
            	</tr>
            	<tr>
           	<?php if(in_array('v_access',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/rolls/view','viewContent','manipulateContent','Rolls')"><i class="master"></i>Roles</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left; width: 50px;" class="link-blue" onclick="permission('Rolls')"><i class="master"></i>Roles</td>
			<?php
			} 
			?>
			<?php if(in_array('v_access',$thisper)) 
			{
			?>
			</tr><tr>
            	<td style="cursor:pointer; text-align:left; width: 211px;" class="link-blue" onclick="getModule('masters/accesscontrol/index','viewContent','manipulateContent','Access Control')"><i class="master"></i>Access Control</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Access Control')"><i class="master"></i>Access Control</td>
			<?php
			} 
			?>            	
            	</tr></table>
<table cellpadding="5" cellspacing="5" width="25%" style="padding-left:50px;font-size:14px !important">
<tr>
            	<th colspan="2" style="float:left;color: rgb(112, 112, 201);">Company Profile</th>
            	
            	</tr>
            	<tr>
           	<?php if(in_array('v_cmpd',$thisper)) 
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/companydetails/view','viewContent','manipulateContent','Company Details')"><i class="master"></i>Company Details</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left;" class="link-blue" onclick="permission('Company Details')"><i class="master"></i>Company Details</td>
			<?php
			} 
			?>
			<?php if(in_array('v_cmpp',$thisper)) 
			{
			?>
			</tr><tr>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="getModule('masters/uploadocument/index','viewContent','manipulateContent','Upload Document')"><i class="master"></i>Company Policy</td>
			<?php 
			}
			else
			{
			?>
            	<td style="cursor:pointer; text-align:left" class="link-blue" onclick="permission('Upload Document')"><i class="master"></i>Company Policy</td>
			<?php
			} 
			?>            	
            	</tr></table>

</div> 
