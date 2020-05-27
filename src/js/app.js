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