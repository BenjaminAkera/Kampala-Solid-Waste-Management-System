/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.login;
import com.lwaasa.lamech.kased.util.RecordManager;

// the username is stored at record 1
// the password is stored at record 2
public class Login
{
	private final String RS = "LOGIN";
	private RecordManager rm;
	
	public Login()
	{
		rm = new RecordManager(RS);
	}
	
	public String getUsername()
	{
		return rm.getRecord(1);
	}
	
	public String getPassword()
	{
		return rm.getRecord(2);
	}
	
	public void setUsername(String username)
	{
		if(rm.numRecords() == 0)
		{ //rm empty so add the record
			rm.addRecord(username);
		}
		else
		{
			//rm not empty, overwrite the record
			rm.setRecord(1, username);
		}
	}
	
	public void setPassword(String password)
	{
		if(rm.numRecords() == 1)
		{ //rm empty so add the record
			rm.addRecord(password);
		}
		else
		{
			//rm not empty, overwrite the record
			rm.setRecord(2, password);
		}
	}
}
