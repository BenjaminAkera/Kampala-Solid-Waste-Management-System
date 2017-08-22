/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.gui;
import javax.microedition.lcdui.*;

import com.lwaasa.lamech.kased.login.Login;
import com.lwaasa.lamech.kased.midlet.MidletCollection;
import com.lwaasa.lamech.kased.util.CommandBuilder;
import com.lwaasa.lamech.kased.util.RecordManager;

public class FormLogin extends Form implements CommandListener
{
	// items
	private TextField tfUsername;
	private TextField tfPassword;
	
	// RS name
	private final String RS = "LOGIN";
	
	// midlet
	private MidletCollection midlet;
	
	//previous display
	private Displayable previousDisplay;
	
	// commands
	private static final Command cmStoreLogin = CommandBuilder.getStoreLogin();
	private static final Command cmBack = CommandBuilder.getBack();
	private static final Command cmMain = CommandBuilder.getMain();
	private static final Command cmExit = CommandBuilder.getExit();	
	
	// login manager
	private Login login;
	
	public FormLogin(MidletCollection midlet, Displayable previousDisplay)
	{
		super("Login");
		//midlet
		this.midlet = midlet;
		//previous display
		this.previousDisplay = previousDisplay;
		
		//text fields
		tfUsername = new TextField("Username", "", 20, TextField.ANY);
		tfPassword = new TextField("Password", "", 20, TextField.ANY);
		
		//add the items to the form
		append(tfUsername);
		append(tfPassword);
		
		//add the commands
		addCommand(cmStoreLogin);
		addCommand(cmExit);
		addCommand(cmBack);
		addCommand(cmMain);
	
		//command listener
		setCommandListener(this);
		
		// login manager
		login = new Login();
		
	}
	
	//clear the fields
	public void clearFields()
	{
		tfPassword.setString("");		
		tfUsername.setString("");
	}
	
	public void commandAction(Command c, Displayable d)
	{
		if(c == cmExit) //exit the app
		{
			midlet.shutDownApp(false);
		}
		//Note: the back and main commands can be invoked only if there is already a login info
		RecordManager rm = new RecordManager(RS);
		int numRecords = rm.numRecords();
		if(c == cmBack) //previous display
		{
			if(numRecords < 2)
				notValidData();
			else
				midlet.setDisplay(previousDisplay);
		}
		else if(c == cmMain) // main menu
		{
			if(numRecords < 2)
				notValidData();
			else			
				midlet.setDisplay(midlet.getMain());
		}
		else if(c == cmStoreLogin) //store the new login info
		{
			String username = tfUsername.getString().trim();
			String password = tfPassword.getString().trim();
			
			//check the validity of the fields
			if(username.equals("") || password.equals(""))
			{
				//not valid
				notValidData();
			}
			else
			{
				//store the new login info
				login.setUsername(username);
				login.setPassword(password);
				
				//get back to the previous display
				midlet.setDisplay(previousDisplay);
			}
		}
	}
	
	private void notValidData()
	{
		Alert alert = new Alert("Error", "You must supply both username and password, try again", null, AlertType.INFO);
		alert.setTimeout(Alert.FOREVER);
		midlet.setDisplay(alert, this);
	}		
}
			
		
	