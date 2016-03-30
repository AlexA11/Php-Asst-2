<?php
include_once("Asst2Include.php");
include_once("Asst2DatabaseFunctions.php"); 
function SetUpForm( $Character )
{
    WriteHeaders();
    echo "
    <div class = \"top\">
	   Music - Student Full Name
	</div>
    <div class = \"bigpiece\">
	  <div class = \"leftpiece\"> 
	    
         <p>" ;
         
         if(strpbrk($Character, "H"))
				{
					echo"<form action=? method=post>";
					DisplayButton("nextPage", "Home" , "WelcomePage");
					 echo"</form>";
				}
                
         if(strpbrk($Character, "F"))
				{
					echo"<form action=? method=post>";
					DisplayButton("nextPage", "Find Record" , "FoundRecord");
					 echo"</form>";
				}         
		
	      echo"<form action=? method=post>";
		if(strpbrk($Character, "S"))
			{
				echo"<input type=submit name=\"nextPage\" class=\"submit\" value=\"Save\"> ";
			}
        if(strpbrk($Character, "C"))
			{
				echo"<form action=? method=post>";
					DisplayButton("nextPage", "Save Changes" , "ChangesMade");
					 echo"</form>";
			}
			
		elseif(	!strpbrk($Character, "S") && !strpbrk($Character, "H"))
		{
		 DisplayButton("nextPage", "Create Table", "CreateTable");
   	     DisplayButton("nextPage", "Add Record", "EnterData");
         DisplayButton("nextPage", "Modify Record", "ModifyRecord");
         DisplayButton("nextPage", "Display Data", "DisplayData");
		}
			
		echo" </p>
	  </div>
	  <div class = \"middlepiece\" >	    
	 ";
    
	
}

function FinishForm()
{
    echo"
        </form>
        </div>
	  <div class = \"rightpiece\">
	  	 
	     <p>";
		 DisplayImage("music.png", "music" );
	echo"	 </p>
	  </div>
	</div>";
    WriteFooters();
}

function DisplayMainForm()
{
    SetupForm("");
    //display a welcome message
    DisplayLabel("Welcome!");
    FinishForm();
}

function DataEntryForm()
{
	SetUpForm("SH");
	
	echo"<div class=\"leftinput\" >";
	
	DisplayLabel("Band Name: ");
	DisplayTextBox("bandName", "20", "");
	echo"<br/>";
	echo"<br/>";
	
	DisplayLabel("Number of CD's Sold: ");
	DisplayTextBox("numCD", "20", "");
	echo"<br/>";
	echo"<br/>";
	
	DisplayLabel("CD Selling Price: ");
	DisplayTextBox("cdPrice", "20", "");
	echo"<br/>";
	echo"<br/>";
	
	DisplayLabel("Manager Fee: ");
	echo"<br /><input required type=\"radio\" value=\"45\" name=\"managerFee\" >45% <br />";
	echo"<input  type=\"radio\" value=\"55\" name=\"managerFee\" >55% <br />";
	echo"<br/>";
	
	DisplayLabel("Recording Studio");
	echo"
	<select required name=\"recordingStudio\">
		<option value=\"NA\">N\A</option>
		<option value=\"RRRS\">Rock Rules Recording Studio</option>
		<option value=\"STMS\">Sing To Me Studios</option>
		<option value=\"MSNS\">Make Some Noise Studios</option>
	</select>
	<br />";
	echo"<br/>";
	
	DisplayLabel("Advance");
	echo"<input type=\"checkbox\" name=\"advance\" value=\"advance\" />";
	echo"<br/>";
	echo"<br/>";
	
	echo"</div>";
	
	DisplayLabel("Distributer Fees: ");
	DisplayTextBox("distFee", "10", "");
	echo"<br/>";
	echo"<br/>";
	
	DisplayLabel("Manufacturing Costs: ");
	DisplayTextBox("manuFac", "10", "");
	echo"<br/>";
	echo"<br/>";
	
	DisplayLabel("Gig Date (YYYY/MM/DD): ");
	DisplayTextBox("gigDate", "10", "");
	echo"<br/>";
	echo"<br/>";
	
	FinishForm();
}
function ResultsForm()
{
	SetUpForm("H");
	
	$BandName = $_POST["bandName"];
	$NumCd = $_POST["numCD"];
	$CdPrice = $_POST["cdPrice"];
	$ManagerFee = $_POST["managerFee"];
	$RecordingStudio = $_POST["recordingStudio"];
	$Advance = $_POST["advance"];
	$DistFee = $_POST["distFee"];
	$ManuFac = $_POST["manuFac"];
	$GigDate = $_POST["gigDate"];
	
	$totalRev = $NumCd * $CdPrice;
	
	$totalManageFee=0;
	
	if($RecordingStudio == "RRRS")
	{
		$totalManageFee = 0.05 * $totalRev;
	}
	if($RecordingStudio == "STMS")
	{
		$totalManageFee = 0.10 * $totalRev;
	}
	if($RecordingStudio == "MSNS")
	{
		$totalManageFee = 0.15 * $totalRev;
	}
	if($Advance == "advance")
	{
		$advanceValue = 1000;
	}
	if($ManagerFee == "45")
	{
		$ManagerFee = $totalRev * 1.45;
	}
	if($ManagerFee == "55")
	{
		$ManagerFee = $totalRev * 0.55;
	}
	
	
	 
	 $totalExpenses = $ManagerFee + $totalManageFee + $advanceValue + $DistFee + $ManuFac;
	 $netIncome = $totalRev - $totalExpenses;
	 $netIncome = number_format($netIncome, 2, '.', ',');
	 $totalRev = number_format($totalRev, 2, '.', ',');
	 $totalManageFee = number_format($totalManageFee, 2, '.', '');
	$totalExpenses = number_format($totalExpenses, 2, '.', ',');
	
	echo"<div class=\"dataFormat\" >";
	echo"<strong>Breakdown of Revenue</strong>
	Number of CDs Sold: $NumCd
	CD Purchase Price: $CdPrice
	     Total Revenue: $$totalRev
		 
	
	<strong>Breakdown of Expenses</strong>
	Management Fees: $ManagerFee
	Recording Cost: $totalManageFee
	Advance: $advanceValue
	Distributer Fees: $DistFee
	Manufacturing Costs: $ManuFac
	     Total Expenses: $$totalExpenses
	
	
	$BandName's Net Income is $$netIncome. Next gig is $GigDate
	";
	
	echo"</div>";
	FinishForm();
}

function CreateTableForm()
{
    SetUpForm("H");
	
    echo"Table has been created message will appear here";
    FinishForm();
}

function DisplayData()
{
    SetUpForm("H");
    echo"All Data Will Show Here";
    FinishForm();
}

function ModifyRecord()
{
    SetUpForm("HF");
    echo"You can search records here";
    FinishForm();
}

function ShowFoundRecord()
{
    SetUpForm("HC");
    echo"Show Found Record page";
    FinishForm();
}

function WriteFoundRecordData()
{
    SetUpForm("H");
    echo"Record has been saved to the database";
    FinishForm();
}
//main
if (!isset($_POST["nextPage"])) 
 DisplayMainForm();
elseif (!strcmp($_POST["nextPage"], "EnterData")) 
	  DataEntryForm();
  elseif(!strcmp($_POST["nextPage"], "Save")) 
	  ResultsForm();
	  elseif(!strcmp($_POST["nextPage"], "WelcomePage"))
        DisplayMainForm();
        elseif(!strcmp($_POST["nextPage"], "CreateTable"))
          CreateTableForm();
           elseif(!strcmp($_POST["nextPage"], "ModifyRecord"))
            ModifyRecord();
            elseif(!strcmp($_POST["nextPage"], "DisplayData"))
                DisplayData();
                elseif(!strcmp($_POST["nextPage"], "FoundRecord"))
                    ShowFoundRecord();
                     elseif(!strcmp($_POST["nextPage"], "ChangesMade"))
                    WriteFoundRecordData();
  
?>