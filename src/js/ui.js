/**
 * Handles fighter user interface stuff.
 */
class FighterUI {

    constructor ( root ) {

        this.rootNode = root;
        this.oldDisabled = undefined;

        this.mainAvatar = this.rootNode.getElementsByClassName("featured-cat-fighter-image")[0];
    }

    showFighterInfo () {

        const catInfoNode = this.rootNode.getElementsByClassName("cat-info")[0];
        
        this.rootNode.getElementsByClassName("featured-cat-fighter-image")[0].src = this.fighter !== null ? this.fighter.image : "https://via.placeholder.com/300";
        catInfoNode.getElementsByClassName("name")[0].innerHTML = this.fighter !== null ? this.fighter.name : "Cat Name";
        catInfoNode.getElementsByClassName("age")[0].innerHTML = this.fighter !== null ? this.fighter.age : "Cat age";
        catInfoNode.getElementsByClassName("skills")[0].innerHTML = this.fighter !== null ? this.fighter.skills : "Cat Info";
        catInfoNode.getElementsByClassName("record")[0].innerHTML = this.fighter !== null ? ( "WINS: " + this.fighter.wins + " LOSS: " + this.fighter.loss ) : "Wins: Loss:";
    }

    showFighterBorder ( fighter ) {

        if( this.fighter !== undefined && this.fighter !== null ) {

            this.fighter.element.childNodes[0].nextSibling.style.border = "none";
        }
        
        if( fighter != null ) {
            
            fighter.element.childNodes[0].nextSibling.style.border = "thick solid gray";
        }
        this.fighter = fighter;
    }

    fadeEnemyFighter( fighter ) {

        if( this.oldDisabled !== undefined ) {

            this.oldDisabled.element.childNodes[0].nextSibling.style.border = "none";
            this.oldDisabled.enableFighter();
        }

        fighter.element.childNodes[0].nextSibling.style.border = "thick solid red";
        fighter.disableFighter();
        this.oldDisabled = fighter;
    }
}