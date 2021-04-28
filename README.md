![banner](https://user-images.githubusercontent.com/78657082/115743054-26dd2f00-a346-11eb-8514-afe07d425bc0.jpg)

# SlotsPlus 

A pocketmine plugin which allows you to fake player slots or get unlimited player slots.

<a href="https://poggit.pmmp.io/p/SlotsPlus"><img src="https://poggit.pmmp.io/shield.state/SlotsPlus"></a>
<a href="https://github.com/Cr1mDev/SlotsPlus/releases"><img src="https://user-images.githubusercontent.com/78657082/115741287-74589c80-a344-11eb-83bc-98c11b464855.png"></a>

# Notes

- The plugin will **NOT** work if you enable both unlimitedSlots and fakePlayers. Only enable one at a time.
- This plugin will **NOT** add fake players to your server. It'll only add fake filled up slots.

# How do I use it?

Once you've downloaded the plugin, Put the plugin in your server's plugin folder. After that, Edit the config.yml file (Found at resources\config.yml) to 
satisfy your needs. If you want unlimited player slots, Set the "unlimitedSlots" value to true. If you don't, Set it to false. If you want to fake your 
player slots, Set the "fakeSlots" value to the amount of fake slots you want. If you don't want to fake your slots, Set it to false. 

# Commands & Permissions

| | |
| --- | --- |
| `FakePlayers Command` | `SlotsPlus.command.fakeplayers` |  
| `UnlimitedSlots` | `SlotsPlus.command.unlimitedslots` |  

| | |     
| --- | --- |
| `FakePlayers` | `/unlimitedslots` |
| `UnlimitedSlots` | `/fakeplayers <number>` |

# Configuration (config.yml)
```yaml
---
# Allows you to have unlimited player slots on your server. Setting this to true will scale player slots when a player joins. 
# (Eg. When 1 player joins, Minecraft will display it as 1/2 players. When another player joins, It will display it as 2/3 and so and so on.)
unlimitedSlots: true

# Amount of fake slots.
fakeSlots: 10
...
```
