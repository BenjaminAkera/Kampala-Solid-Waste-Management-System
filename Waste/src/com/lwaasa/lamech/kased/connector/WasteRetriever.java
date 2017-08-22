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

public class WasteRetriever implements Runnable
{
	private String username;
	private String password;
        private String vehicle;
	private String URL = "http://localhost/wastemgt/mobile/mob_retriever.php";
	private MidletCollection midlet;
	private Displayable previousDisplay;
        private String waste;

	public WasteRetriever(MidletCollection midlet, Displayable previousDisplay,
			String username, String password, String vehicle)
	{
		this.username = username;
		this.password = password;
                this.vehicle = vehicle;
		this.midlet = midlet;
		this.previousDisplay = previousDisplay;
	}

	public void run()
	{
		try
		{
			getWaste();
		}
		catch (Exception e)
		{
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

	private void getWaste() throws IOException
	{
		InputStream is = null;
		StringBuffer sb = null;
		HttpConnection http = null;
		try
		{
			// append the credentials and the author's username onto the URL
			URL += "?username=" + username + "&password=" + password +
						 "&vehicle=" + vehicle;
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
				waste = sb.toString();
			else
				networkError();
			if (http != null)
				http.close();
		}

		if (waste != null)
		{
			System.out.println(waste);
			midlet.showPosts(waste, getCurrentDisplay());
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

	private void networkError(String msg)
	{
		midlet.showInfo(msg, getCurrentDisplay());
	}
	private void networkError()
	{
		midlet.showInfo("Network error, try later", getCurrentDisplay());
	}
}


