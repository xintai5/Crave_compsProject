# Replication Instructions and Code Architechure Overview

My web app is online and accessbile at: [https://xintaiao.online/]

# Replication Instructions

To replicate my senior comprehensive project in the instanse you change/add features to it, follow these steps:

- Download the SQL files "konbert-export-83ff7e1ec9784.sql" and "GH_all_food"
- Next you will have to mimci creating a host server and client using localhost and XAMPP
- Download the a version of XAMPP compatible with your device.
- Install and set up XAMPP
- On XAMPP create a MySQL database. Insert the downloaded SQL files into this database.
- Move all files downloaded from XAMPP into the htdocs solder where XAMPP was downlaoded.
- Then, in all the PHP pages that you downlaoded with ExploreLA, modify the MySQL login details to match your own account.
- Download all files in the "public_html" folder

# Code Architecture

```from selenium import webdriver
import os


def scrape_restaurants(base_url, location):
    driver = webdriver.Chrome(executable_path="chromedriver_win32/chromedriver.exe")
    driver.get(base_url + location)

    categories = driver.find_element_by_xpath("/html/body/div/div/main/div[2]/div[3]"). \
        text.replace(" ", "-").lower().splitlines()

    for cat in categories:
        try:
            driver.get(base_url + location + "/" + cat)
            temp_urls = driver.find_element_by_xpath("/html/body/div/div/main/div[5]").find_elements_by_tag_name("a")
            for url in temp_urls:
                out_file = open("temp_urls.txt", "a")
                out_file.write(str(url.get_attribute("href")) + "\n")
        except:
            print("Skipped " + cat)

    out_file.close()

    lines_seen = set()  # holds lines already seen
    out_file = open(location + "_restaurant_urls.txt", "w+")
    for line in open("temp_urls.txt", "r"):
        if line not in lines_seen:  # not a duplicate
            out_file.write(line)
            lines_seen.add(line)
    out_file.close()

    os.remove("temp_urls.txt")
    
```
```
from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
import os
import time
import json


def get_item(browser, id):
    """ given an id, scrape a menu item and all of its options """
    button = browser.find_element_by_id(id)
    browser.execute_script("arguments[0].click();", button)
    time.sleep(1)

    innerHTML = browser.page_source
    html = BeautifulSoup(innerHTML, 'html.parser')

    _options = {}
    options = html.find_all('div', class_='menuItemModal-options') # menuItemModal-choice-option-description
    for option in options:
        name = option.find(class_='menuItemModal-choice-name').text
        choices = option.find_all('span', class_='menuItemModal-choice-option-description')
        if ' + ' in choices[0].text:
            _choices = {choice.text.split(' + ')[0]:choice.text.split(' + ')[1] for choice in choices}
        else:
            _choices = [choice.text for choice in choices]
        _options[name] = _choices
    return _options

def get_menu(url):
    """ given a valid grubhub url, scrape the menu of a restaurant """
    print('Running...')
    chrome_options = Options()
    # To disable headless mode (for debugging or troubleshooting), comment out the following line:
    chrome_options.add_argument("--headless")

    browser = webdriver.Chrome(options=chrome_options)
    browser.get(url)
    time.sleep(10)
    innerHTML = browser.page_source

    html = BeautifulSoup(innerHTML, 'html.parser')

    menu = html.find(class_="menuSectionsContainer");
    if menu is None:
        print('menu fail')
        get_menu(url)
        return
    # Categories
    cats = menu.find_all('ghs-restaurant-menu-section')
    cats = cats[1:]

    cat_titles = [cat.find('h3', class_='menuSection-title').text for cat in cats]
    cat_items = [[itm.text for itm in cat.find_all('a', class_='menuItem-name')] for cat in cats]
    prices = [[p.text for p in cat.find_all('span', class_='menuItem-displayPrice')] for cat in cats]

    ids = []
    for cat in cats:
        cat_ids = []
        items = cat.find_all('div', class_='menuItem-inner')
        for item in items:
            cat_ids.append(item.get('id'))
        ids.append(cat_ids)

    full_menu = {}
    for ind, title in enumerate(cat_titles):
        all_items = []
        for ind2, itm_name in enumerate(cat_items[ind]):
            item = {}
            item['name'] = itm_name
            item['price'] = prices[ind][ind2]
            item['options'] = get_item(browser, ids[ind][ind2])
            all_items.append(item)
        full_menu[title] = all_items
    path = '/'.join(os.path.realpath(__file__).split('/')[:-1])
    with open(f'{path}/data.json', 'w') as f:
        json.dump(full_menu, f, indent=4)
    print('[Finished]')
get_menu(input('Grubhub Link?  '))
#example link: 'https://www.grubhub.com/restaurant/chipotle-5047-eagle-rock-blvd-los-angeles/2122168'
```

Intial respective UberEats and GrubHub scrapers used until better method was found (Octoparse: web-scrapping API).

```
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

```
Intial search code that parsed through each csv file of UberEats and GrubHub individual food items.

```
$sql = "SELECT * FROM `UE_all_food` WHERE `Dish_name` LIKE '%".$searchquery."%'  ORDER BY `Dish_price`";



$result= mysqli_query($conn, $sql);

$resutsisNone = "true";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    
$resutsisNone = "false";
 $restaurantName = $row["Restaurant_name"];
 $dishName = $row["Dish_name"];
 $dishPrice = $row["Dish_price"];
 $deliveryFee = $row["Delivery_Fee"];
 $deliveryTime = $row["Delivery_Time"];
 

 echo '<div class="w-row">
    <div class="w-col w-col-6">
      <div class="div-block" style="margin-bottom:10px;">
        <div class="text-block">'.$restaurantName.'<br>‍</div>
        <div class="text-block">'.$dishName.'</div>
        <div class="text-block">'.$dishPrice.'<br>‍</div>
        <div class="text-block">'.$deliveryFee.'<br>‍</div>
        <div class="text-block">'.$deliveryTime.'<br></div>
      </div>
    </div>
    <div class="w-col w-col-6">
      <div class="div-block" style="margin-bottom:10px;">
        <div class="text-block">'.$restaurantName.'<br>‍</div>
        <div class="text-block">'.$dishName.'</div>
        <div class="text-block">'.$dishPrice.'<br>‍</div>
        <div class="text-block">'.$deliveryFee.'<br>‍</div>
        <div class="text-block">'.$deliveryTime.'<br></div>
      </div>
    </div>
  </div>';
 
}
if ($resutsisNone = "true"){
    echo '<div class="text-block">We could not find anymore matching food items to your search.</div>';
}
```

This function in the result.php file (lines 67-109) under the public_html folder is a very important function. This function takes the data within the phpMyAdmin page and  outputs the two lists of user search results in relation to the SQL files containing the large amount UberEats and GrubHub webscrapped data.

```
  <p class="paragraph affwcrt">Please enter desired food item:</p>
  <div class="form-block w-form">
    <form id="email-form" name="email-form" data-name="Email Form" action="results.php" method="get"><input type="text" class="w-input" maxlength="256" name="FoodSearchQuery" data-name="Email" placeholder="Ex: Burrito, Pad Thai, etc." id="email" required=""><input type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button"></form>
    <div class="w-form-done">
      <div>Thank you! Your submission has been received!</div>
    </div>
    <div class="w-form-fail">
      <div>Oops! Something went wrong while submitting the form.</div>
    </div>
```
    
This line of code within index.html (lines 19-27) output the intial text at the beginning of the web app before the user inputs their search key.


