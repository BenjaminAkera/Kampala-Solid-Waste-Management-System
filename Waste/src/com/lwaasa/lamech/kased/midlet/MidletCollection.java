/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.midlet;
import javax.microedition.lcdui.Alert;
import javax.microedition.lcdui.AlertType;
import javax.microedition.lcdui.Command;
import javax.microedition.lcdui.CommandListener;
import javax.microedition.lcdui.Display;
import javax.microedition.lcdui.Displayable;
import javax.microedition.lcdui.List;
import javax.microedition.midlet.MIDlet;

import com.lwaasa.lamech.kased.gui.FormDisplayWaste;
import com.lwaasa.lamech.kased.gui.FormDownloadWaste;
import com.lwaasa.lamech.kased.gui.FormLogin;
import com.lwaasa.lamech.kased.gui.FormWriteWaste;
import com.lwaasa.lamech.kased.model.Waste;
import com.lwaasa.lamech.kased.util.CommandBuilder;
import com.lwaasa.lamech.kased.util.WasteParser;
import com.lwaasa.lamech.kased.util.RecordManager;

public class MidletCollection extends MIDlet implements CommandListener
{
	// menu items
	private static final String[] MENU_ITEMS = {"Record Waste", "Review Entries",
																							"Logout"};
	// display
	private Display display;
	
	// list representing the main menu
	private List lsMain;
	//commands for the main menu
	private Command cmExit = CommandBuilder.getExit();
	private Command cmSelect = CommandBuilder.getSelect();
	// form representing the login
	private FormLogin fmLogin;
	// write post form
	private FormWriteWaste fmWriteWaste;
	// download post form
	private FormDownloadWaste fmDownloadWaste;

	public MidletCollection()
	{
		super();
		
		// main menu list
		lsMain = new List("Waste", List.IMPLICIT, MENU_ITEMS, null);
		//add the commands to the main menu
		lsMain.addCommand(cmExit);
		lsMain.addCommand(cmSelect);
		//set the command listener 
		lsMain.setCommandListener(this);
		
		// the other displayable elements:
		// login form
		fmLogin = new FormLogin(this, lsMain);
		// write post form
		fmWriteWaste = new FormWriteWaste(this, lsMain);
		// write post form
		fmDownloadWaste = new FormDownloadWaste(this, lsMain);
		
		//the display
		display = Display.getDisplay(this);
		
	}

	protected void startApp()
	{
		// check if there is the login info already stored
		if (isLoginEmpty())
		{
			setDisplay(fmLogin);
		}
		else
		{
			setDisplay(lsMain);
		}
	}

	protected void pauseApp()
	{}

	protected void destroyApp(boolean unconditional)
	{
		lsMain = null;
		fmLogin = null;
		display = null;
	}
	
	public void shutDownApp(boolean unconditional)
	{
		destroyApp(unconditional);
		notifyDestroyed();
	}
	
	public void setDisplay(Displayable d)
	{
		display.setCurrent(d);
	}

	public void setDisplay(Alert a, Displayable d)
	{
		display.setCurrent(a, d);
	}
	
	public Displayable getMain()
	{
		return lsMain;
	}
	
	private boolean isLoginEmpty()
	{
		RecordManager rm = new RecordManager("LOGIN");
		return (rm.numRecords() < 2);
	}

	public void commandAction(Command c, Displayable d)
	{
		if(c == cmExit)
		{
			shutDownApp(false);
		}
		else if(c == cmSelect) 
		{
			// detect the menu item selected
			int menuIndex = lsMain.getSelectedIndex();
			
			switch(menuIndex)
			{
				case 0: // write post
				{
					System.out.println("Record Waste");
					setDisplay(fmWriteWaste);
					break;
				}
				case 1: // download post
				{
					System.out.println("Review Entry");
					setDisplay(fmDownloadWaste);
					break;
				}
				case 2: // logout
				{
					System.out.println("Logout");
					// delete the login data
					RecordManager rm = new RecordManager("LOGIN");
					rm.deleteRS();
					//clear the fields of the login form
					fmLogin.clearFields();
					//set fmLogin as the current display
					setDisplay(fmLogin);
					break;
				}
			}
		}
		
	}
	
	// show the post downloaded
	public void showPosts(String rawPost, Displayable d)
	{
		
		WasteParser pp = new WasteParser(rawPost);
		try
		{
			//extract the Post from the rawPost
			Waste waste = pp.parse();
			//fill the form FormDisplayPost with the info extracted
			FormDisplayWaste fdp = new FormDisplayWaste(this, d, waste);
			//display it
			setDisplay(fdp);
		}
		catch(IllegalArgumentException iae)
		{
			System.out.println(iae.getMessage());
			//display alert
			showInfo(iae.getMessage(), d);
		}
		catch(IllegalStateException ise)
		{
			System.out.println(ise.getMessage());
			//display alert
			showInfo(ise.getMessage(), d);
		}
		catch(Exception e)
		{
			e.printStackTrace();
			//display alert
			showInfo(e.getMessage(), d);
		}
	}
	
	// show the info passed in
	public void showInfo(String info, Displayable d)
	{
		// create an alert
		Alert alert = new Alert("Info", info, null, AlertType.INFO);
		// modal alert
		alert.setTimeout(Alert.FOREVER);
		// show the alert
		setDisplay(alert, d);
	}
	
	// return the current display
	public Displayable getCurrentDisplay()
	{
		return display.getCurrent();
	}

}

