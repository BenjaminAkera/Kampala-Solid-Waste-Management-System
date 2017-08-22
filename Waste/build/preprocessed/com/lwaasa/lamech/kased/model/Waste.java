/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package com.lwaasa.lamech.kased.model;

public class Waste
{
	private String vehicle;
	private String postingDate;
	private String collectionSite;
	private String dumpingSite;
        private String mileage;
	private String loadWeight;
        private String fuelGauge;

      

	public Waste(String vehicle, String postingDate, 
			String collectionSite, String dumpingSite, String mileage, String loadWeight, String fuelGauge)
	{
		this.vehicle = vehicle;
		this.postingDate = postingDate;
		this.collectionSite = collectionSite;
		this.dumpingSite = dumpingSite;
		this.mileage = mileage;
		this.loadWeight = loadWeight;
                this.fuelGauge = fuelGauge;
               
	}
	
	public Waste()
	{}
	
	public String getVehicle()
	{
		return vehicle;
	}
	public void setStation(String station)
	{
		this.vehicle = vehicle;
	}
	public String getPostingDate()
	{
		return postingDate;
	}

	public void setPostingDate(String postingDate)
	{
		this.postingDate = postingDate;
	}
	public String getCollectionSite()
	{
		return collectionSite;
	}
	public void setCollectionSite(String collectionSite)
	{
		this.collectionSite = collectionSite;
	}
	public String getDumpingSite()
	{
		return dumpingSite;
	}
	public void setDumpingSite(String dumpingSite)
	{
		this.collectionSite = collectionSite;
	}
	public String getMileage()
	{
		return mileage;
	}
	public void setMileage(String mileage)
	{
		this.mileage = mileage;
	}
	public String getLoadWeight()
	{
		return loadWeight;
	}
	public void setLoadWeight(String loadWeight)
	{
		this.loadWeight = loadWeight;
	}
	public String getFuelGauge()
	{
		return fuelGauge;
	}
	public void setFuelGauge(String fuelGauge)
	{
		this.fuelGauge = fuelGauge;
	}  
	
	public String toString()
	{
		return "Vehicle: " + vehicle +
					 " Date: " + postingDate + 
					 " CollectionSite: " + collectionSite + 
					 " DumpingSite: " + dumpingSite +
					 " Mileage: " + mileage + 
					 " LoadWeight: " + loadWeight+
					 " FuelGauge: " + fuelGauge;
	}
}

