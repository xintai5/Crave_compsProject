import numpy as np
import pandas as pd

excel_file ='GrubHub_Restaurants.xlsx'
df = pd.read_excel(excel_file)
# print(df)

cuisine = input("Cuisine Type: ")
asian = df['Restaurant'].where(df['Cuisine'] == cuisine)
# print(asian)
# print("\n")
print(asian.dropna())

asian = df['Name'].where(df['Cuisine'] == cuisine)

excel_files = ['GrubHub_RestaurantList.xlsx','UberEats_Restaurants.xlsx']
