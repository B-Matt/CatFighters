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
        this.id = info.id;
        this.name = info.name;
        this.age = info.age;
        this.skills = info.skills;
        this.wins = Number(info.wins);
        this.loss = Number(info.loss);
    }
}