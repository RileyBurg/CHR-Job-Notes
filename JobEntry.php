<?php
session_start();
require 'database.php';

$recIdSQL		= "SELECT id FROM notes WHERE archive = '0'";
$recDateSql 	= "SELECT note_dt FROM notes WHERE archive = '0'";
$recJobSql 		= "SELECT jobnum FROM notes WHERE archive = '0'";
$recUsrSql 		= "SELECT usrnme FROM notes WHERE archive = '0'";
$recRepNameSql 	= "SELECT report_name FROM notes WHERE archive = '0'";
$recCstCdeSql 	= "SELECT cost_code FROM notes WHERE archive = '0'";
$recPhaseSql 	= "SELECT phase FROM notes WHERE archive = '0'";
$recMetTypeSql	= "SELECT meeting_type FROM notes WHERE archive = '0'";
$recNoteSql 	= "SELECT note FROM notes WHERE archive = '0'";
$recArchSql		= "SELECT archive FROM notes WHERE archive = '0'";

$recIdRes		= mysqli_query($connection, $recIdSQL);
$recDateRes 	= mysqli_query($connection, $recDateSql);
$recJobRes		= mysqli_query($connection, $recJobSql);
$recUsrRes		= mysqli_query($connection, $recUsrSql);
$recRepNmeRes	= mysqli_query($connection, $recRepNameSql);
$recCstCdeRes	= mysqli_query($connection, $recCstCdeSql);
$recPhaseRes 	= mysqli_query($connection, $recPhaseSql);
$recMetTypeRes	= mysqli_query($connection, $recMetTypeSql);
$recNoteRes		= mysqli_query($connection, $recNoteSql);
$recArchRes		= mysqli_query($connection, $recArchSql);

$recResNum = mysqli_num_rows($recDateRes);

$recIdArray 		= array();
$recDateArray  		= array();
$recJobArray 		= array();
$recUsrArray	 	= array();
$recRepNameArray	= array();
$recCstCdeArray		= array();
$recPhaseArray 		= array();
$recMetTypeArray 	= array();
$recNoteArray 		= array();
$recArchArray		= array();

//FILTERED SUMMARY TABLE DATA STORAGE IN ARRAYS (ALL)
while($recDateRow = mysqli_fetch_array($recDateRes))
{
	$recDateArray[] = array($recDateRow['note_dt']);	
}
while($recJobRow = mysqli_fetch_array($recJobRes))
{
	$recJobArray[] = array($recJobRow['jobnum']);	
}
while($recUsrRow = mysqli_fetch_array($recUsrRes))
{
	$recUsrArray[] = array($recUsrRow['usrnme']);	
}
while($recRepNmeRow = mysqli_fetch_array($recRepNmeRes))
{
	$recRepNmeArray[] = array($recRepNmeRow['report_name']);	
}
while($recCstCdeRow = mysqli_fetch_array($recCstCdeRes))
{
	$recCstCdeArray[] = array($recCstCdeRow['cost_code']);	
}
while($recPhaseRow = mysqli_fetch_array($recPhaseRes))
{
	$recPhaseArray[] = array($recPhaseRow['phase']);	
}
while($recMetTypeRow = mysqli_fetch_array($recMetTypeRes))
{
	$recMetTypeArray[] = array($recMetTypeRow['meeting_type']);	
}
while($recNoteRow = mysqli_fetch_array($recNoteRes))
{
	$recNoteArray[] = array($recNoteRow['note']);	
}
while($recIdRow = mysqli_fetch_array($recIdRes))
{
	$recIdArray[] = array($recIdRow['id']);	
}
while ($recArchRow = mysqli_fetch_array($recArchRes)) 
{
	$recArchArray[] = array($recArchRow['archive']);
}

$recDateString 		= json_encode($recDateArray);
$recJobString 		= json_encode($recJobArray);
$recUsrString 		= json_encode($recUsrArray);
$recRepString 		= json_encode($recRepNmeArray);
$recCstCdeString 	= json_encode($recCstCdeArray);
$recPhaseString 	= json_encode($recPhaseArray);
$recMetTypeString 	= json_encode($recMetTypeArray);
$recNoteString 		= json_encode($recNoteArray);
$recIdString 		= json_encode($recIdArray);
$recArchString 		= json_encode($recArchArray);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<script type="text/javascript">
	function view_text () 
	{
    	// Find html elements.
    	var textArea = document.getElementById('my_text');
    	var div = document.getElementById('view_text');

    	// Put the text in a variable so we can manipulate it.
    	var text = textArea.value;

    	// Make sure html and php tags are unusable by disabling < and >.
    	text = text.replace(/\</gi, "<");
    	text = text.replace(/\>/gi, ">");

    	// Exchange newlines for <br />
    	text = text.replace(/\n/gi, "<br />");

    	// Basic BBCodes.
    	text = text.replace(/\[b\]/gi, "<b>");
    	text = text.replace(/\[\/b\]/gi, "</b>");
        text = text.replace(/\[i\]/gi, "<i>");
        text = text.replace(/\[\/i\]/gi, "</i>");
        text = text.replace(/\[u\]/gi, "<u>");
        text = text.replace(/\[\/u\]/gi, "</u>");

        // Print the text in the div made for it.
        div.innerHTML = text;
    }


    function mod_selection (val1,val2) 
    {
    	// Get the text area
    	var textArea = document.getElementById('my_text');

    	// IE specific code.
    	if( -1 != navigator.userAgent.indexOf ("MSIE") ) 
    	{
    	    var range = document.selection.createRange();
    	    var stored_range = range.duplicate();

    	    if(stored_range.length > 0) 
    	    {
    	    	stored_range.moveToElementText(textArea);
    	    	stored_range.setEndPoint('EndToEnd', range);
    	    	textArea.selectionstart = stored_range.text.length - range.text.length;
    	    	textArea.selectionend = textArea.selectionstart + range.text.length;
    	    }

    	}

    	  // Do we even have a selection?

    	if (typeof(textArea.selectionstart) != "undefined") 
    	{
    		// Split the text in three pieces - the selection, and what comes before and after.
    		var begin = textArea.value.substr(0, textArea.selectionstart);
    		var selection = textArea.value.substr(textArea.selectionstart, textArea.selectionend - textArea.selectionstart);
    		var end = textArea.value.substr(textArea.selectionend);

    	    // Insert the tags between the three pieces of text.
    	    textArea.value = begin + val1 + selection + val2 + end;
        }

    }
</script>

	<title>Job Notes</title>
	<h1 style = "margin-top: 2%; margin-bottom: 5px;">Job Notes</h1>
	<p style="margin-top: 5px;margin-bottom: 2%;"><a style="text-decoration: none" href="http://www.poolhouse.lancs.sch.uk/images/images/gold-star[1].jpg"><font size="6">*</font></a><font size="3">= Required Field</font></p>
</head>

<body onload="tableOnLoad();">
	<form id="hidden_action_form" method="post">
		
		<div style="text-align: left;margin-left: 40%; margin-top: 20px;display: block;">
			<div style="text-align: left;">
				<label style = "display: block;" for = "reportName"><font size="6">*</font>Report Name:</label>
				<input style="margin-top:10px; margin-left: 5px;" type="text" id="repName" name="repName">
			</div>
			<div style="text-align: left; padding-left: 222px;">
				<label style = "display: block;" for="Date"> <font size="6">*</font>Date: </label>
				<input style="margin-top:10px;" type="date" value="<?php echo date('Y-m-d'); ?>" id="Date" name="inDate">
			</div>
		</div>
		
		<div style="float: left; margin-left: 20%;">
			<div style="text-align: left;margin-left: 15%; display: block;">
				<div>
					<label style = "display: block;" for = "noteType"> <font size="6">*</font>Note Type: </label>
					<input style="margin-top:10px; width: 80px;" list="nteType" type="text" id="type" name="nteType">
					<datalist id="nteType">
						<option value="WIP">WIP</option>
						<option value="Aging">Aging</option>
						<option value="Hours">Hours</option>
						<option value="General">General</option>
					</datalist>
				</div>
			</div>	
			<div style="text-align: left; margin-left: 15%; margin-top: 40px;display: block;">
				<label style = "display: block;" for="job"><font size="6">*</font>Job Number: </label>
				<input style="margin-top:10px;" type="text" id="job" name="job"/>
			</div>
			<div style="text-align: left; margin-left: 15%; margin-top: 40px;display: block;">
				<label style = "display: block;" for="phase">Phase: </label>
				<input style="margin-top:10px;" type="text" id="phase" name="phase" />
			</div>
			<div style="text-align: left; margin-left: 15%; margin-top: 40px;display: block;">
				<label style = "display: block;" for="costCode"> Cost Code: </label>
				<input style="margin-top:10px;" type="text" id="costCode" name="costCode">
			</div>
			<div style="text-align: left; margin-left: 15%; margin-top: 40px; display: block;">
				<label style = "display: block;" for = "enteredBy"><font size="6">*</font>Entered By:</label>
				<input style="margin-top: 10px;" list="eDropDown" id="enteredBy" name="enteredBy"/>
			</div>
		</div>
		
		<div style="margin-right: 10%; margin-top: 30px; float: center;">
			
			<textarea style = "width: 535px; height: 430px;" class="text_edit" id="my_text" name="notes"></textarea>

			<div id="view_text">
			</div>
		</div>

		<input style="margin-top: 3%; margin-left: auto; margin-right: auto; margin-bottom: 3%; display: block;" type="submit" class="cheesecake" />
	</form>
	
	<form id="filter_form" method="post">
		<div style="display: block; text-align: left; margin-left: 10%;">
			<label>Job Filter:</label>
			<input type="Number" name="jobFilter" id="searchNumb" style=" width: 80px; margin-left: 15px;" />
			<input type="submit" name="sendFilter" class="hamburger" value="Go" onclick="filterJob(this); return false;" />
			<input type="submit" name="showAll" class="hotdog" value="Show All" onclick="clearTable(); tableOnLoad(); return false;"/>
		</div>
	</form>
	
	<div id="rectangle" class="shadow">
	<table id="sum_table">
  		<thead>
  			<tr>
  				<th>ID</th>
  				<th>Date</th>
				<th>Job #</th>
				<th>Entered By</th>
				<th>Cost Code</th> 
				<th>Phase</th>
				<th>Report Name</th> 
				<th>Note Type</th>
				<th>Notes</th>
				<th>Edit</th>
				<th>Archive</th>
  			</tr>
  		</thead>
  	</table>
  	</div><br>
  
  <div id="openArchModal" class="modalDialog">
  	<div>
  		<h2>Archiving Record</h2>
		<p style="margin-bottom: 20px;">Are you sure you'd like to archive this note?</p>
		<form  id="archiveForm" method="POST">
			<input style="margin-top:10px; width: 40px; height: 20px;" type="Number" id="id" name="idfield"/>
			<input style="margin-top: 3%; margin-left: auto; margin-right: auto; margin-bottom: 3%; display: block;" type="submit" value="Yes" class="cheesecake" />
		</form>
			<a href="#close" title="Close"><input class="cheesecake" style="margin-top: 3%; margin-left: auto; margin-right: auto; margin-bottom: 3%; display: block;" type="submit" value="No"/></a>
		
	 </div>	
  </div>

  <div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Editing Note</h2>
		<p>Please make adjustments to the following note.</p>
	<form id="hidden_action_form2" method="post">
		<div style="text-align: left;padding-left: 10px;">
			<label for = "noteType"> Note Type: </label>
			<input style="margin-top:10px; width: 70px;" list="nteType" type="text" id="type2" name="nteType2">
			<datalist id="nteType">
				<option value="WIP">WIP</option>
				<option value="Aging">Aging</option>
				<option value="Hours">Hours</option>
				<option value="General">General</option>
			</datalist>
		</div>	

		<div style="text-align: left;padding-left: 10px;">
			<label for="job">Job Number: </label>
			<input style="margin-top:10px;" type="text" id="job2" name="job2"/>
		</div>

		<div style="text-align: left;padding-left: 10px;">
			<label for="phase">Phase: </label>
			<input style="margin-top:10px;" type="text" id="phase2" name="phase2" />
		</div>

		<div style="text-align: left;padding-left: 10px;">
			<label for="costCode"> Cost Code: </label>
			<input style="margin-top:10px;" type="text" id="costCode2" name="costCode2">
		</div>

		<div style="text-align: left;padding-left: 10px;">
			<label for="Date"> Date: </label>
			<input style="margin-top:10px;" type="date" value="<?php echo date('Y-m-d'); ?>" id="Date2" name="inDate2">
		</div>

		<div style="text-align: left;padding-left: 10px;">
			<label for = "reportName">Report Name:</label>
			<input style="margin-top:10px; margin-left: 5px; width: 70px;" type="text" id="repName2" name="repName2">
		</div>	

		<div style="text-align: left;padding-left: 10px;">
			<label for = "notes"> Notes: </label>
			<textarea style = "width: 800px; height: 100px;" class="text_edit" id="notes2" name="notes2"></textarea>
		</div>
		<div style="text-align: left;padding-left: 10px;">
		<label for = "enteredBy">ID:</label>
			<input style="margin-top:10px; width: 40px; height: 20px;" type="Number" id="id2" name="idfield2"/>
		</div>
		<div style="text-align: left;padding-left: 10px;">
			<label for = "enteredBy">Entered By:</label>
			<input style="margin-top: 10px;" id="enteredBy2" name="enteredBy2"/>
		</div>

		<input style="margin-top: 3%; margin-left: auto; margin-right: auto; margin-bottom: 3%; display: block;" type="submit" class="cheesecake" />
	</form>

<script type="text/javascript">

	document.getElementById('hidden_action_form').action = 'MeetingEntrySubmit.php';
	document.getElementById('hidden_action_form2').action = 'MeetingEntryEdit.php';
	document.getElementById('archiveForm').action = 'archNote.php';
	
	//SUMMARY TABLE W/ Filter Arrays
	recDateVars 	= <?= $recDateString ?>;
	recJobVars 		= <?= $recJobString ?>;
	recUsrVars 		= <?= $recUsrString ?>;
	recRepVars 		= <?= $recRepString ?>;
	recCstCdeVars 	= <?= $recCstCdeString ?>;
	recPhaseVars 	= <?= $recPhaseString ?>;
	recMetTypeVars 	= <?= $recMetTypeString ?>;
	recNoteVars 	= <?= $recNoteString ?>;
	recTotal 		= <?= $recResNum ?>;
	recId 			= <?= $recIdString?>;
	recArch			= <?= $recArchString ?>; 

	var sumTable 	= document.getElementById('sum_table');
	var tblfrag 	= document.createDocumentFragment();
	
	var tblData 	= document.createElement("td");

	let recDateAll 		= [];
	let recJobAll 		= [];
	let recUsrAll 		= [];
	let recRepAll 		= [];
	let recCstAll 		= [];
	let recPhaseAll 	= [];
	let recMetTypeAll 	= [];
	let recNoteAll 		= [];
	let recIdAll		= [];
	let archived		= [];
	
	recDateAll 		= recDateVars; 
	recJobAll 		= recJobVars;
	recUsrAll 		= recUsrVars;
	recRepNmeAll	= recRepVars;
	recCstAll 		= recCstCdeVars;
	recPhaseAll 	= recPhaseVars;
	recMetTypeAll 	= recMetTypeVars;
	recNoteAll 		= recNoteVars;
	recIdAll		= recId;
	archived		= recArch;

	var text = 'Edit';
	var edit = text.link('#openModal');

	var arch = 'Archive';
	var archive = arch.link('#openArchModal');
	var count = 0;
	function tableOnLoad()
	{	
		for (var i = 0; i < recTotal; i++) 
		{
			if (archived[i] == 1) 
				count++;
			else
			{
				var rwAtt = document.createAttribute("onclick");
				rwAtt.value = "editIndex(this); archId(this)";
				var tblRow = document.createElement("tr");
				tblRow.setAttributeNode(rwAtt);
					tblRow.innerHTML =
					'<td>' + recIdAll[i] +'</td>' +
					'<td>' + recDateAll[i] +'</td>' +
					'<td>' + recJobAll[i] +'</td>' +
					'<td>' + recUsrAll[i] +'</td>' +
					'<td>' + recCstAll[i] +'</td>' +
					'<td>' + recPhaseAll[i] +'</td>' +
					'<td>' + recRepNmeAll[i] +'</td>' +
					'<td>' + recMetTypeAll[i] +'</td>' +
					'<td>' + recNoteAll[i] +'</td>' +
					'<td>' + edit + '</td>'+
					'<td>' + archive + '</td>';
				sumTable.appendChild(tblRow);
			}
		}
	}
	function clearTable()
	{
		var sum_table = document.getElementById("sum_table");
		sum_table.innerHTML = "";
		sum_table.innerHTML = 
		'<thead>' + 
			'<tr>' +
				'<th>'+ "ID" +'</th>' +
				'<th>'+ "Date" +'</th>' +
				'<th>'+ "Job #" + '</th>' +
				'<th>'+ "Entered By" + '</th>' + 
				'<th>'+ "Cost Code" + '</th>' +
				'<th>'+ "Phase" + '</th>' + 
				'<th>'+ "Report Name" + '</th>' +
				'<th>'+ "Note Type" + '</th>' +
				'<th>'+ "Notes" + '</th>' +
				'<th>'+ "Edit" + '</th>' +
				'<th>'+ "Archive" + '</th>' +
  			'</tr>' +
  		'</thead>';
	}

	function filterJob()
	{
		var td;
		var input = document.getElementById("searchNumb");
		var table = document.getElementById("sum_table");
  		var tr = table.getElementsByTagName("tr");
		for (var i = 1; i <= recTotal; i++) 
		{
			td = tr[i].getElementsByTagName("td")[2];
			console.log(td.innerHTML);
			if (input.value == td.innerHTML && archived[i] == 0) 
			{
				tr[i].style.display = "";
			}
			else
			{
				tr[i].style.display = "none";
			}
		}
	}

	function editIndex(trValue) 
	{
		var repName = recRepNmeAll[trValue.rowIndex - 1]
		var date = recDateAll[trValue.rowIndex - 1];
		var job = recJobAll[trValue.rowIndex - 1];
		var usr = recUsrAll[trValue.rowIndex - 1];
		var costCode = recCstAll[trValue.rowIndex - 1];
		var phase = recPhaseAll[trValue.rowIndex - 1];
		var metType = recMetTypeAll[trValue.rowIndex - 1];
		var notes = recNoteAll[trValue.rowIndex - 1];
		
		var formType = document.getElementById('type2')
		var formJob = document.getElementById('job2');
		var formDate = document.getElementById('Date2');
		var formPhase = document.getElementById('phase2');
		var formCost = document.getElementById('costCode2');
		var formRep = document.getElementById('repName2');
		var formEntBy = document.getElementById('enteredBy2');
		var formNotes = document.getElementById('notes2');
		
		formType.value = metType; 
		formJob.value = job;
		formDate.value = date;
		formPhase.value = phase;
		formCost.value = costCode;
		formRep.value = repName;
		formEntBy.value = usr;
		formNotes.value = notes;
		document.getElementById('id2').value = recIdAll[trValue.rowIndex - 1];
	}

	function archId(trValue)
	{
		document.getElementById('id').value = recIdAll[trValue.rowIndex - 1];
	}

</script>
</body>
</html>