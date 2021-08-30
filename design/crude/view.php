<div class="title">My Employees</div>
<div class="strip">
<span>Dashboard</span>
<span>Masters</span>
<span>Employee</span>
</div>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td style="width:30%" ></td>
<td style="width:70%" align="right"><button class="button blue" onclick="getModule('crude/new','manipulatemoodleContent','viewmoodleContent','Dependent')"> <i class="editlarge"></i>  Edit</button>&nbsp;&nbsp;
<div style="display:inline-block;position:relative">
<div class="dropdown-menu">
<div class="dropdown-menu-inner">
<div class="dropdown-menu-inner-title">
Select Tools</div>
<div style="background:#fff;">
<ul>
<li><i class="delete-icon-black"></i>Delete</li>
<li><i class="edit-icon-black"></i>Edit</li>
<li style="border-bottom:1px #d8d8d8 solid"><i class="user-icon-black"></i>Change Owner</li>
<li style="padding:10px 0 10px 13px"><i class="task-icon-black"></i>Add Task
<div style="float:right;padding-right:10px;">
<span class="roundspan red">2</span>
</div>
</li>
</ul>
</div>
</div>
</div>
	<button class="button red" data-toggle="dropdown">Tools&nbsp;&nbsp; <i class="down-arrow"></i>
											</button>
</div>
											
											
</td>
</tr>
</table>


<table width="100%" cellpadding="5" cellspacing="0"  class="fetch">
<tbody><tr><th style="width:5%;"><input id="mainChk" name="Checkbox1" onclick="chkAll('chBx','mainChk')" type="checkbox"></th>
	<th style="width:10%;">Empid</th>
	<th>Name</th>
	<th>Email</th>
	<th>Phone</th>
	<th>Job Description</th>
</tr>
<tr class="d1" id="fetchrow1">
<td><input id="chBx1" name="Checkbox1" type="checkbox" value="1"></td>
<td >EMP045</td>
<td class="link-blue">Admin</td>
<td >pranay.dongre@webricks.com</td>
<td >9893401143</td>
<td >Analyst</td>
</tr>
<tr class="d0" id="fetchrow2">
<td><input id="chBx2" name="Checkbox1" type="checkbox" value="3"></td>
<td >EMP565</td>
<td  class="link-blue">Swati</td>
<td >swati@gmail.com</td>
<td >8878866969</td>
<td >Software Developer</td>
</tr>
<tr class="d1" id="fetchrow3">
<td><input id="chBx3" name="Checkbox1" type="checkbox" value="4"></td>
<td >EMP783</td>
<td  class="link-blue">Harshita</td>
<td ></td>
<td ></td>
<td ></td>
</tr>
<tr class="d0" id="fetchrow4">
<td><input id="chBx4" name="Checkbox1" type="checkbox" value="5"></td>
<td >EMP996</td>
<td  class="link-blue">Dipti</td>
<td >dipti@webricks.com</td>
<td >9999900000</td>
<td ></td>
</tr>

</tbody></table>