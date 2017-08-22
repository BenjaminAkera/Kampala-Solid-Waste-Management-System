/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.util;

import java.util.Vector;

import com.lwaasa.lamech.kased.model.Waste;

public class WasteParser
{
	//String used to separate the items
	private static final String SPLITTER = "|";
	
	//post in the raw format which is: vehicle|date|mileage|fuel........
  private String rawPost = "";
  //index pointer used by the parser
  private int index;
  
  public WasteParser(String rawPost)
  {
  	this.rawPost = rawPost;
  	this.index = 0;
  }
	
	public Waste parse()
	{
		//check if the argument is valid
		if(rawPost.length() == 0)
		{
			throw new IllegalArgumentException("Empty String passed");
		}
		//extract the 6 items of the post
		String[] items = extractItems();
		//if the items are != 10 then an exception is thrown
		if(items.length == 1)
		{
			//the server returned an error message which is in items[0]
			throw new IllegalStateException(items[0]);
		}
		if(items.length != 7)
		{
			//the post returned is not in the format 
			throw new IllegalStateException("The collection info is in a wrong format");
		}
		//return a post built up by the items extracted
		return new Waste(items[0], items[1], items[2], items[3], items[4], items[5], items[6]);
	}

	//extract the itms of the post and put them in a String array
	private String[] extractItems()
	{
		Vector v = new Vector();
		//find the first occurrence of the SPLITTER
		int endIndex = rawPost.indexOf(SPLITTER, index);
		String item = "";
		//extract the items until the end of the last SPLITTER found in the rawPost string
		while(endIndex != -1)
		{
			item = rawPost.substring(index, endIndex);
			index = endIndex + 1;
			endIndex = rawPost.indexOf(SPLITTER, index);
			v.addElement(item);
		}
		//extract the rest of the rawPost (the text item)
		item = rawPost.substring(index);
		v.addElement(item);
		String[] ret = new String[v.size()];
		//copy the content of the Vector in a string array
		v.copyInto(ret);
		return ret;
	}

}