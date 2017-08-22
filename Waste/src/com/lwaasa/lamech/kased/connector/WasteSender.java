/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.connector;

/**
 *
 * @author xues
 */
import java.io.IOException;
import java.io.InputStream;

import javax.microedition.io.Connector;
import javax.microedition.io.HttpConnection;
import javax.microedition.lcdui.Displayable;

import com.lwaasa.lamech.kased.midlet.MidletCollection;

public class WasteSender implements Runnable
{

	private String username;
	private String password;
        private String fuelGauge;
        private String loadWeight;
        private String mileage;
        private String dumpingSite;
        private String collectionSite;
	private String vehicle;
	//private String text;
	private String URL = "http://localhost/wastemgt/mobile/mobile_collection.php";
	private MidletCollection midlet;
	private Displayable previousDisplay;
	private String result;
	
	public WasteSender(MidletCollection midlet, Displayable previousDisplay,
			String username, String password, String vehicle, String collectionSite, String dumpingSite,String mileage,
                        String loadWeight,String fuelGauge)
	{
		this.midlet = midlet;
		this.previousDisplay = previousDisplay;
		this.username = username;
		this.password = password;
		this.vehicle = vehicle;
                this.collectionSite = collectionSite;
                this.dumpingSite = dumpingSite;
                this.mileage = mileage;
                this.loadWeight = loadWeight;
                this.fuelGauge = fuelGauge;

	}

	public void run()
	{
		try
		{
			sendWaste();
		}
		catch (Exception e)
		{
			e.printStackTrace();
			System.err.println("Error: " + e.toString());
			networkError(e.toString());
		}
	}

	public void start()
	{
		Thread t = new Thread(this);
		try
		{
			t.start();
		}
		catch (Exception e)
		{
			System.err.println("Error: " + e.toString());
			networkError(e.toString());
		}
	}

	private void sendWaste() throws IOException
	{
		InputStream is = null;
		StringBuffer sb = null;
		HttpConnection http = null;
		try
		{
			// append the query string onto the URL
			URL += "?username=" + username + "&password=" + password + "&vehicle=" + vehicle + "&collectionSite="+ collectionSite
			+ "&dumpingSite="+dumpingSite+ "&mileage="+ mileage+ "&loadWeight="+loadWeight+ 
					"&fuelGauge="+ fuelGauge;
			// replace not allowed char in the URL
			URL = EncodeURL(URL);
			// establish the connection
			http = (HttpConnection) Connector.open(URL);
			// set the request method as GET
			http.setRequestMethod(HttpConnection.GET);
			// server response
			if (http.getResponseCode() == HttpConnection.HTTP_OK)
			{
				sb = new StringBuffer();
				int ch;
				is = http.openInputStream();
				while ((ch = is.read()) != -1)
					sb.append((char) ch);
			}
			else
			{
				System.out.println("Network error");
				networkError();
			}
		}
		catch (Exception e)
		{
			System.err.println("Error: " + e.toString());
			networkError(e.toString());
		}
		finally
		{
			if (is != null)
				is.close();
			if (sb != null)
				result = sb.toString();
			else
				networkError();
			if (http != null)
				http.close();
		}

		if (result != "")
		{
			System.out.println(result);
			midlet.showInfo(result, getCurrentDisplay());
		}
		else
		{
			networkError();
		}

	}

	private Displayable getCurrentDisplay()
	{
		// get the current display
		Displayable d = midlet.getCurrentDisplay();
		// if it is an Alert set the next display as the previous one
		if (d.getClass().getName().equals("javax.microedition.lcdui.Alert"))
		{
			d = previousDisplay;
		}
		return d;
	}

	private String EncodeURL(String URL)
	{
		URL = replace(URL, '�', "%E0");
		URL = replace(URL, '�', "%E8");
		URL = replace(URL, '�', "%E9");
		URL = replace(URL, '�', "%EC");
		URL = replace(URL, '�', "%F2");
		URL = replace(URL, '�', "%F9");
		URL = replace(URL, '$', "%24");
		URL = replace(URL, '#', "%23");
		URL = replace(URL, '�', "%A3");
		URL = replace(URL, '@', "%40");
		URL = replace(URL, '\'', "%27");
		URL = replace(URL, ' ', "%20");

		return URL;
	}

	private String replace(String source, char oldChar, String dest)
	{
		String ret = "";
		for (int i = 0; i < source.length(); i++)
		{
			if (source.charAt(i) != oldChar)
				ret += source.charAt(i);
			else
				ret += dest;
		}
		return ret;
	}

	private void networkError()
	{
		midlet.showInfo("Network error, try later", getCurrentDisplay());
	}
	private void networkError(String msg)
	{
		midlet.showInfo(msg, getCurrentDisplay());
	}
}
