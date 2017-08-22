/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.gui;

/**
 *
 * @author xues
 */
import javax.microedition.lcdui.Command;
import javax.microedition.lcdui.CommandListener;
import javax.microedition.lcdui.Displayable;
import javax.microedition.lcdui.Form;
import javax.microedition.lcdui.TextField;

import com.lwaasa.lamech.kased.connector.WasteSender;
import com.lwaasa.lamech.kased.login.Login;
import com.lwaasa.lamech.kased.midlet.MidletCollection;
import com.lwaasa.lamech.kased.util.CommandBuilder;
import javax.microedition.lcdui.*;

public class FormWriteWaste extends Form implements CommandListener
{
	//midlet
	private MidletCollection midlet;
	//previous display
	private Displayable previousDisplay;
	private String veh;
        private String colsite;
        private String dump;
        private String mile;
        private String weight;
        private String fuel;

	//items
	private ChoiceGroup tfVehicle;
	private ChoiceGroup tfCollectionSite;
	private ChoiceGroup tfDumpingSite;
	private ChoiceGroup tfMileage;
	private ChoiceGroup tfLoadWeight;
	private ChoiceGroup tfFuelGauge;

      
	
	//commands
	private static final Command cmExit = CommandBuilder.getExit();
	private static final Command cmUpload = CommandBuilder.getUpload();
	private static final Command cmBack = CommandBuilder.getBack();

	public FormWriteWaste(MidletCollection midlet, Displayable previousDisplay)
	{
		//call the Form constructor passing the title
		super("Record Waste Collection Data");
		
		this.midlet = midlet;
		this.previousDisplay = previousDisplay;

                tfVehicle = new ChoiceGroup ("Vehicle Id", Choice.POPUP, new String[] {"LG002311", "LG006010", "LG007712", "LG008890", "LG186213", "LG206040", "LG306012", "LG906910"}, null);
                tfCollectionSite = new ChoiceGroup ("CollectionSite", Choice.POPUP, new String[] {"site1", "site2", "site3", "site4", "site5", "site6", "site7", "site8", "site9", "site10"}, null);
                tfDumpingSite = new ChoiceGroup ("DumpingSite", Choice.POPUP, new String[] {"Kiteezi", "Namuwongo"}, null);
                tfMileage = new ChoiceGroup ("Mileage", Choice.POPUP, new String[] {"760", "761", "762", "763", "764", "765", "766", "767", "768", "769", "770", "771", "772", "773", "774", "775", "776", "777", "778", "779", "780", "781", "782", "783", "784", "785", "786", "787", "788", "789", "790", "791", "792", "793", "794", "795", "796", "797", "798", "799", "800", "801", "802", "803", "804", "805", "806", "807", "808", "809", "810", "811", "812", "813", "814", "815", "816", "817", "818", "819", "820", "821", "822", "823", "824", "825", "826", "827", "828", "829", "830", "831", "832", "833", "834", "835", "836", "837", "838", "839", "840", "841", "842", "843", "844", "845", "846", "847", "848", "849", "850", "851", "852", "853", "854", "855", "856", "857", "858", "859", "860", "861", "862", "863", "864", "865", "866", "867", "868", "869", "870", "871", "872", "873", "874", "875", "876", "877", "878", "879", "880", "881", "882", "883", "884", "885", "886", "887", "888", "889", "890", "891", "892", "893", "894", "895", "896", "897", "898", "899", "900"}, null);
                tfLoadWeight = new ChoiceGroup ("LoadWeight", Choice.POPUP, new String[] {"1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84", "85", "86", "87", "88", "89", "90", "91", "92", "93", "94", "95", "96", "97", "98", "99", "100"}, null);
                tfFuelGauge = new ChoiceGroup ("FuelGauge", Choice.POPUP, new String[] {"0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84", "85", "86", "87", "88", "89", "90", "91", "92", "93", "94", "95", "96", "97", "98", "99", "100", "101", "102", "103", "104", "105", "106", "107", "108", "109", "110", "111", "112", "113", "114", "115", "116", "117", "118", "119", "120", "121", "122", "123", "124", "125", "126", "127", "128", "129", "130", "131", "132", "133", "134", "135", "136", "137", "138", "139", "140", "141", "142", "143", "144", "145", "146", "147", "148", "149", "150", "151", "152", "153", "154", "155", "156", "157", "158", "159", "160", "161", "162", "163", "164", "165", "166", "167", "168", "169", "170", "171", "172", "173", "174", "175", "176", "177", "178", "179", "180", "181", "182", "183", "184", "185", "186", "187", "188", "189", "190", "191", "192", "193", "194", "195", "196", "197", "198", "199", "200", "201", "202", "203", "204", "205", "206", "207", "208", "209", "210", "211", "212", "213", "214", "215", "216", "217", "218", "219", "220", "221", "222", "223", "224", "225", "226", "227", "228", "229", "230", "231", "232", "233", "234", "235", "236", "237", "238", "239", "240", "241", "242", "243", "244", "245", "246", "247", "248", "249", "250", "251", "252", "253", "254", "255", "256", "257", "258", "259", "260", "261", "262", "263", "264", "265", "266", "267", "268", "269", "270", "271", "272", "273", "274", "275", "276", "277", "278", "279", "280", "281", "282", "283", "284", "285", "286", "287", "288", "289", "290", "291", "292", "293", "294", "295", "296", "297", "298", "299", "300", "301", "302", "303", "304", "305", "306", "307", "308", "309", "310", "311", "312", "313", "314", "315", "316", "317", "318", "319", "320", "321", "322", "323", "324", "325", "326", "327", "328", "329", "330", "331", "332", "333", "334", "335", "336", "337", "338", "339", "340", "341", "342", "343", "344", "345", "346", "347", "348", "349", "350", "351", "352", "353", "354", "355", "356", "357", "358", "359", "360"}, null);
                
		
		//append the items to the form
		append(tfVehicle);
		append(tfCollectionSite);
		append(tfDumpingSite);
		append(tfMileage);
		append(tfLoadWeight);
		append(tfFuelGauge);

              
		
		//add the commands to the form
		addCommand(cmExit);
		addCommand(cmUpload);
		addCommand(cmBack);
		
		//set the command listener
		setCommandListener(this);	
	}

	//called when a command is selected
	public void commandAction(Command c, Displayable d)
	{
		if(c == cmExit)
		{
			midlet.shutDownApp(false);
		}
		else if(c == cmBack)
		{
			midlet.setDisplay(previousDisplay);
		}
		else if(c == cmUpload)
		{
                    for(int i = 1; i< tfVehicle.size(); i++){
                        if(tfVehicle.isSelected(i) == true)
                            veh = tfVehicle.getString(i);  
                    }
                    
                    for(int i = 1; i< tfCollectionSite.size(); i++){
                        if(tfCollectionSite.isSelected(i) == true)
                            colsite = tfCollectionSite.getString(i);  
                    }
                    for(int i = 1; i< tfDumpingSite.size(); i++){
                        if(tfDumpingSite.isSelected(i) == true)
                            dump = tfDumpingSite.getString(i);  
                    }
                    for(int i = 1; i< tfMileage.size(); i++){
                        if(tfMileage.isSelected(i) == true)
                            mile = tfMileage.getString(i);  
                    }
                    for(int i = 1; i< tfLoadWeight.size(); i++){
                        if(tfLoadWeight.isSelected(i) == true)
                            weight = tfLoadWeight.getString(i);  
                    }
                    for(int i = 1; i< tfFuelGauge.size(); i++){
                        if(tfFuelGauge.isSelected(i) == true)
                            fuel = tfFuelGauge.getString(i);  
                    }
                   
                    }
                    //unitText = new String(units.getString(units.getSelectedIndex()));
			//retrieve login data
			Login login = new Login();
			//username
                        //int i = java.lang.Integer.parseInt(s)
			String username = login.getUsername();
			//password
			String password = login.getPassword();
			String vehicle = veh;
			String collectioSite = colsite;
			String dumpingSite = dump;
			String mileage = mile;
			String loadWeight = weight;     
			String fuelGauge = fuel;

			WasteSender pr = new WasteSender(midlet, this, 
					username, password, vehicle, collectioSite,dumpingSite,
                                mileage, loadWeight, fuelGauge);
			pr.start();
		}
		
	}



