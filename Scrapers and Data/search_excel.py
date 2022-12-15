import pandas as pd
pd.set_option('display.width', 400)
pd.set_option('display.max_columns', 10)
pd.set_option('display.max_rows', 100000)


excel_file ='UE_Individual restaurant menu items.xlsx'
df = pd.read_excel(excel_file)
df = df.where(df['Dish_category'] != 'Picked for you')  # Remove all 'picked for you' rows
df = df.dropna()

food_query = input("Food: ")


restaurants = df['Restaurant_name'].where(df['Dish_name'] == food_query)
sub = df.loc[df['Dish_name'].str.contains(food_query, case=False)]

print(sub[['Restaurant_name', 'Dish_name', 'Dish_price']])
"""
, 'Delivery_Fee', 'Delivery_Time'
"""
# cuisine = df['Restaurant'].where(df['Cuisine'] == 'Asian')

excel_files = ['GrubHub_Restaurants.xlsx', 'UberEats_Restaurants.xlsx']

"""
for individual_excel_file in excel_files:
    df = pd.read_excel(individual_excel_file)
    cuisine = df['Restaurant'].where(df['Cuisine'] == 'American').dropna()
    print("File Name" + individual_excel_file)
    print(cuisine)"""

#asian = df['Name'].where(df['Cuisine'] == cuisine)

#excel_files = ['GrubHub_RestaurantList.xlsx','UberEats_Restaurants.xlsx']
