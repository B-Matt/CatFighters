/**
 * Model class that holds cat fighter information in JSON format.
 */
class CatFighter {

    constructor ( side, element, src ) {

        this.side = side;
        this.element = element;
        this.image = src;
        this.disabled = false;

        this._parseFighterInfo( element.getAttribute( "data-info" ) );
    }

    enableFighter () {

        this.disabled = false;
    }

    disableFighter () {

        this.disabled = true;
    }

    _parseFighterInfo ( info ) {

        info = JSON.parse( info );
        this.name = info.name;
        this.age = info.age;
        this.skills = info.catInfo;
        this.wins = info.record.wins;
        this.loss = info.record.loss;
    }
}

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

/**
 * Handles game stuff like countdown, battle, selecting fighters etc.
 */
class CatFighting {

    constructor ( allFighters ) {

        this.fighters = allFighters;

        this.fighterUi = [
            new FighterUI( document.getElementById( "firstSide" ) ),
            new FighterUI( document.getElementById( "secondSide" ) )
        ];

        this.fightButton = document.getElementById( "generateFight" );
        this.fightButton.setAttribute( "disabled", "" );

        this.randomButton = document.getElementById( "randomFight" );
        var scope = this;
        this.randomButton.addEventListener( "click",  ()  => {
            scope.selectRandomFighters();
        } );

        this.fightButton.addEventListener( "click" , () => {

            scope.startBattle();
        } );        

        this.clockValue = 3;
        this.clock = document.getElementById( "clock" );
        this.clock.innerHTML = "";
        
        this.battleMessage = document.getElementById( "message" );
    }

    selectRandomFighters () {

        const leftFighters = this.fighters.filter( x => x.side === 0 );
        const rightFighters = this.fighters.filter( x => x.side === 1 );

        const fighter1 = leftFighters[ Math.round( Math.random() * ( leftFighters.length - 1 ) ) ];
        const fighter2 = rightFighters[ Math.round( Math.random() * ( rightFighters.length - 1 ) ) ];

        if( fighter1.name == fighter2.name || fighter1.disabled || fighter2.disabled ) {
            return this.selectRandomFighters();
        }

        this.selectFighter( fighter1 );
        this.selectFighter( fighter2 );
    }

    selectFighter ( fighter ) {

        if( fighter.disabled ) {

            console.log( fighter );
            return;
        }

        this.fighterUi[ fighter.side ].showFighterBorder( fighter );
        this.fighterUi[ fighter.side ].showFighterInfo();
        this.fighterUi[ fighter.side ].fadeEnemyFighter( this.fighters.find( x => ( x.side === Number(!fighter.side) && x.name === fighter.name ) ) );

        if( this.fighterUi[ 0 ].fighter !== undefined && this.fighterUi[ 1 ].fighter !== undefined ) {
            this.fightButton.removeAttribute( "disabled", "" );
        }
    }

    startBattle () {

        // Calculate Winning Percentages
        this._calculateFighterPercentage(
            ( this.fighterUi[ 0 ].fighter.wins / ( this.fighterUi[ 0 ].fighter.wins + this.fighterUi[ 0 ].fighter.loss ) ) * 100, 
            ( this.fighterUi[ 1 ].fighter.wins / ( this.fighterUi[ 1 ].fighter.wins + this.fighterUi[ 1 ].fighter.loss ) ) * 100
        );

        // Start Battle
        this.clock.innerHTML = this.clockValue;

        this._disableSelectors();
        this._startCountdown ();
    }

    finishBattle () {

        this.clockValue = 3;

        // Show Battle Winner
        let result = this._calculateWinner(); 

        this.battleMessage.innerHTML = this.fighterUi[ result.winner ].fighter.name + " wins!";
        this.fighterUi[ result.winner ].mainAvatar.style.border = "thick solid green";
        this.fighterUi[ result.loser ].mainAvatar.style.border = "thick solid red";

        // Do statistics
        this.fighterUi[ result.winner ].fighter.wins += 1;
        this.fighterUi[ result.loser ].fighter.loss += 1;

        // Toggle Battle Winners
        let scope = this;
        setTimeout( () => {

            scope.battleMessage.innerHTML = "";
            scope.fighterUi[ 0 ].mainAvatar.style.border = "none";
            scope.fighterUi[ 1 ].mainAvatar.style.border = "none";

            scope.fighterUi[ 0 ].showFighterBorder( null );
            scope.fighterUi[ 1 ].showFighterBorder( null );

            scope.fighterUi[ 0 ].showFighterInfo( );
            scope.fighterUi[ 1 ].showFighterInfo( );
        }, 2500 );

        // Enable all selectors
        this._enableSelectors();
    }

    _startCountdown () {

        let scope = this;
        setTimeout(() => {

            if( scope.clockValue <= 0) {

                scope.clock.innerHTML = "";
                scope.finishBattle ();
                return;

            } else {

                scope._startCountdown();
            }

            scope.clock.innerHTML = scope.clockValue;
            scope.clockValue -= 1;            
        }, 1000);
    }

    _disableSelectors() {

        this.fightButton.setAttribute( "disabled", "" );
        this.randomButton.setAttribute( "disabled", "" );

        this.fighters.forEach( ( fighter ) => {            
            
            fighter.disableFighter();
        });
    }

    _enableSelectors () {

        this.randomButton.removeAttribute( "disabled" );

        this.fighters.forEach( ( fighter ) => {            
            
            fighter.enableFighter();
            fighter.element.childNodes[0].nextSibling.style.border = "none";
        });
    }

    _calculateFighterPercentage (standsFighter1, standsFighter2) {

        if ( Math.abs( standsFighter1 - standsFighter2 ) < 10 ) {

            if( this.winPercent1 > this.winPercent2 ) {
                
                this.winPercent1 = [ 0, 0.59 ];
                this.winPercent2 = [ 0.6, 1.0 ];

            } else {

                this.winPercent1 = [ 0, 0.39 ];
                this.winPercent2 = [ 0.4, 1.0 ];
            }
        } else {

            if( this.winPercent1 > this.winPercent2 ) {
                
                this.winPercent1 = [ 0, 0.69 ];
                this.winPercent2 = [ 0.7, 1.0];

            } else {

                this.winPercent1 = [ 0, 0.29 ];
                this.winPercent2 = [ 0.3, 1.0];
                
            }
        }
    }

    _calculateWinner () {

        const x = this._random( 0, 1 );
        let winnerId = 0;
        let loserId = 1;

        if ( x >= this.winPercent1[ 0 ] && x <= this.winPercent1[ 1 ] ) {
            
            winnerId = 0;
            loserId = 1;

        } else {

            winnerId = 1;
            loserId = 0;
        }
        return { winner: winnerId, loser: loserId };
    }

    _random( min, max ) {
        return Math.random() * ( max - min ) + min;
    }
}

// MAIN
let fighters = [];
const fighterBoxes = Array.from( document.getElementsByClassName("fighter-box") );

fighterBoxes.forEach(v => {
    
    const fighterSide = ( v.closest("#firstSide") !== null ? 0 : 1 );
    fighters.push( new CatFighter( fighterSide, v, v.childNodes[0].nextSibling.src ) );
});

const fight = new CatFighting( fighters );

fighterBoxes.forEach(v => v.addEventListener('click', function() {

    fight.selectFighter( fighters.find(x => x.element === v) );
}));