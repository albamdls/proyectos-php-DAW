function createMagicPotion(potions, target) {

    for (let i = 0; i < potions.length; i++) {
        
        for (let j = i; j < potions.length; j++) {
            j++;
            if ((potions[i]+potions[j]) == target) {
                let pos1 = i;
                let pos2 = j;
            }
        }
        
    }

    return undefined
}

//Si no encuentra ninguna combinación devuelve undefined
//Si encuentra más de una combinación posible selecciona la combinación cuya segunda poción aparezca primero en la lista