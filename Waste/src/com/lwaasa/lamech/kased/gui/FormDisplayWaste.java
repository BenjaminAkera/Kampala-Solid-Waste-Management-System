/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.gui;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
import javax.microedition.lcdui.Command;
import javax.microedition.lcdui.Displayable;
import javax.microedition.lcdui.Form;
import javax.microedition.lcdui.CommandListener;
import javax.microedition.lcdui.StringItem;

import com.lwaasa.lamech.kased.midlet.MidletCollection;
import com.lwaasa.lamech.kased.model.Waste;
import com.lwaasa.lamech.kased.util.CommandBuilder;

public class FormDisplayWaste extends Form implements CommandListener
{
	//midlet
	private MidletCollection midlet;
	//previous display
	private Displayable previousDisplay;
	
	//items
	private StringItem siVehicle;
	private StringItem siCollectionSite;
        private StringItem siDumpingSite;
	private StringItem siMileage;
	private StringItem siLoadWeight;
	private StringItem siFuelGauge;
	private StringItem siPostingDate;
	
	//commands
	private static final Command cmExit = CommandBuilder.getExit();
	private static final Command cmMain = CommandBuilder.getMain();
	private static final Command cmBack = CommandBuilder.getBack();

	public FormDisplayWaste(MidletCollection midlet, Displayable previousDisplay,
			Waste waste)
	{
		//call the Form constructor
		super("Collection Data By " + waste.getVehicle());
		
		this.midlet = midlet;
		this.previousDisplay = previousDisplay;
		
		//items
		siVehicle= new StringItem("Vehicle: ", waste.getVehicle());
		siCollectionSite = new StringItem("CollectionSite: ", waste.getCollectionSite());
		siDumpingSite = new StringItem("DumpingSite: ", waste.getDumpingSite());
		siMileage = new StringItem("Mileage: ", waste.getMileage());
		siLoadWeight = new StringItem("LoadWeight: ", waste.getLoadWeight());
		siFuelGauge= new StringItem("FuelGauge: ", waste.getFuelGauge());    
		siPostingDate = new StringItem("Date: ", waste.getPostingDate());
		
		
		//append the items to the form
		append(siVehicle);
		append(siCollectionSite);
                append(siDumpingSite);
		append(siMileage);
		append(siLoadWeight);
		append(siFuelGauge);             
		append(siPostingDate);
		
		//add the commands to the form
		addCommand(cmExit);
		addCommand(cmMain);
		addCommand(cmBack);
		
		//set the command listener
		setCommandListener(this);	
	}

	//called when a command is selected
	public void commandAction(Command c, Displayable d)
	{
		if(c == cmExit) //exit the app
		{
			midlet.shutDownApp(false);
		}
		else if(c == cmBack) // back to the previous Display
		{
			midlet.setDisplay(previousDisplay);
		}
		else if(c == cmMain) //back to the main menu
		{
			midlet.setDisplay(midlet.getMain());
		}
	}
}

