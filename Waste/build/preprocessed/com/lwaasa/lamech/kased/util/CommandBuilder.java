/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.util;
import javax.microedition.lcdui.Command;

public class CommandBuilder
{
	public static Command getSelect()
	{
		return new Command("Select", Command.OK, 1);
	}

	public static Command getExit()
	{
		return new Command("Exit", Command.EXIT, 1);
	}

	public static Command getBack()
	{
		return new Command("Back", Command.BACK, 1);
	}

	public static Command getMain()
	{
		return new Command("Main", Command.ITEM, 1);
	}

	public static Command getDownload()
	{
		return new Command("Review", Command.ITEM, 1);
	}

	public static Command getUpload()
	{
		return new Command("Upload", Command.ITEM, 1);
	}

	public static Command getStoreLogin()
	{
		return new Command("Waste Menu", Command.ITEM, 1);
	}
}