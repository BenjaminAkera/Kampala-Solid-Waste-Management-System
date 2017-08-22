/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.gui;
import javax.microedition.lcdui.Command;
import javax.microedition.lcdui.CommandListener;
import javax.microedition.lcdui.Displayable;
import javax.microedition.lcdui.Form;
import javax.microedition.lcdui.TextField;

import com.lwaasa.lamech.kased.connector.WasteRetriever;
import com.lwaasa.lamech.kased.login.Login;
import com.lwaasa.lamech.kased.midlet.MidletCollection;
import com.lwaasa.lamech.kased.util.CommandBuilder;
import javax.microedition.lcdui.*;

public class FormDownloadWaste extends Form implements CommandListener
{
	//midlet
	private MidletCollection midlet;
	//previous display
	private Displayable previousDisplay;
        private String stat;
	
	//items
	private ChoiceGroup tfFromVehicle;
	
	//commands
	private static final Command cmExit = CommandBuilder.getExit();
	private static final Command cmDownload = CommandBuilder.getDownload();
	private static final Command cmBack = CommandBuilder.getBack();

	public FormDownloadWaste(MidletCollection midlet, Displayable previousDisplay)
	{
		//call the Form constructor passing the title
		super("Review Data");
		
		this.midlet = midlet;
		this.previousDisplay = previousDisplay;
		
		tfFromVehicle = new ChoiceGroup ("From Vehicle:", Choice.POPUP, new String[] {"LG002311", "LG006010", "LG007712	", "LG008890", "LG186213", "LG206040", "LG306012", "LG906910"}, null);
		
		//append the items to the form
		append(tfFromVehicle);
		
		//add the commands to the form
		addCommand(cmExit);
		addCommand(cmDownload);
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
		else if(c == cmDownload)
		{
                    for(int i = 1; i< tfFromVehicle.size(); i++){
                        if(tfFromVehicle.isSelected(i) == true)
                            stat = tfFromVehicle.getString(i);  
                    }
			//retrieve login data
			Login login = new Login();
			//username
			String username = login.getUsername();
			//password
			String password = login.getPassword();
			//author
			//TODO: CHECK THE VALIDITY OF THE stationUser  string STRING
			String station = stat;
			//retrieve the post
			WasteRetriever pr = new WasteRetriever(midlet, this, 
					username, password, station);
			pr.start();
			
		}
		
	}

}
