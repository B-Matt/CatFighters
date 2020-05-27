/**
 * Handles game stuff like countdown, battle, selecting fighters etc.
 */
class CatFighting {

    constructor(allFighters) {

        this.fighters = allFighters;

        this.fighterUi = [
            new FighterUI(document.getElementById("firstSide")),
            new FighterUI(document.getElementById("secondSide"))
        ];

        this.fightButton = document.getElementById("generateFight");
        this.fightButton.setAttribute("disabled", "");

        this.randomButton = document.getElementById("randomFight");
        var scope = this;
        this.randomButton.addEventListener("click", () => {
            scope.selectRandomFighters();
        });

        this.fightButton.addEventListener("click", () => {

            scope.startBattle();
        });

        this.clockValue = 3;
        this.clock = document.getElementById("clock");
        this.clock.innerHTML = "";

        this.battleMessage = document.getElementById("message");
    }

    selectRandomFighters() {

        const leftFighters = this.fighters.filter(x => x.side === 0);
        const rightFighters = this.fighters.filter(x => x.side === 1);

        const fighter1 = leftFighters[Math.round(Math.random() * (leftFighters.length - 1))];
        const fighter2 = rightFighters[Math.round(Math.random() * (rightFighters.length - 1))];

        if (fighter1.name == fighter2.name || fighter1.disabled || fighter2.disabled) {
            return this.selectRandomFighters();
        }

        this.selectFighter(fighter1);
        this.selectFighter(fighter2);
    }

    selectFighter(fighter) {

        if (fighter.disabled) {
            return;
        }

        this.fighterUi[fighter.side].showFighterBorder(fighter);
        this.fighterUi[fighter.side].showFighterInfo();
        this.fighterUi[fighter.side].fadeEnemyFighter(this.fighters.find(x => (x.side === Number(!fighter.side) && x.name === fighter.name)));

        if (this.fighterUi[0].fighter !== undefined && this.fighterUi[1].fighter !== undefined) {
            this.fightButton.removeAttribute("disabled", "");
        }
    }

    startBattle() {

        // Calculate Winning Percentages
        this._calculateFighterPercentage(
            (this.fighterUi[0].fighter.wins / (this.fighterUi[0].fighter.wins + this.fighterUi[0].fighter.loss)) * 100,
            (this.fighterUi[1].fighter.wins / (this.fighterUi[1].fighter.wins + this.fighterUi[1].fighter.loss)) * 100
        );

        // Start Battle
        this.clock.innerHTML = this.clockValue;

        this._disableSelectors();
        this._startCountdown();
    }

    finishBattle() {

        this.clockValue = 3;

        // Show Battle Winner
        let result = this._calculateWinner();

        this.battleMessage.innerHTML = this.fighterUi[result.winner].fighter.name + " wins!";
        this.fighterUi[result.winner].mainAvatar.style.border = "thick solid green";
        this.fighterUi[result.loser].mainAvatar.style.border = "thick solid red";

        // Do statistics
        this.fighterUi[result.winner].fighter.wins += 1;
        this.fighterUi[result.loser].fighter.loss += 1;

        const winner = {
            "fighter-id": this.fighterUi[result.winner].fighter.id,
            "fighter-loss": this.fighterUi[result.winner].fighter.loss,
            "fighter-wins": this.fighterUi[result.winner].fighter.wins,
        };
        const loser = {
            "fighter-id": this.fighterUi[result.loser].fighter.id,
            "fighter-loss": this.fighterUi[result.loser].fighter.loss,
            "fighter-wins": this.fighterUi[result.loser].fighter.wins,
        };

        // Update Database with AJAX
        this._postData('src/php/managers/update_score.php', winner);
        this._postData('src/php/managers/update_score.php', loser);

        // Toggle Battle Winners
        let scope = this;
        setTimeout(() => {

            scope.battleMessage.innerHTML = "";
            scope.fighterUi[0].mainAvatar.style.border = "none";
            scope.fighterUi[1].mainAvatar.style.border = "none";

            scope.fighterUi[0].showFighterBorder(null);
            scope.fighterUi[1].showFighterBorder(null);

            scope.fighterUi[0].showFighterInfo();
            scope.fighterUi[1].showFighterInfo();
        }, 2500);

        // Enable all selectors
        this._enableSelectors();
    }

    _startCountdown() {

        let scope = this;
        setTimeout(() => {

            if (scope.clockValue <= 0) {

                scope.clock.innerHTML = "";
                scope.finishBattle();
                return;

            } else {

                scope._startCountdown();
            }

            scope.clock.innerHTML = scope.clockValue;
            scope.clockValue -= 1;
        }, 1000);
    }

    _disableSelectors() {

        this.fightButton.setAttribute("disabled", "");
        this.randomButton.setAttribute("disabled", "");

        this.fighters.forEach((fighter) => {

            fighter.disableFighter();
        });
    }

    _enableSelectors() {

        this.randomButton.removeAttribute("disabled");

        this.fighters.forEach((fighter) => {

            fighter.enableFighter();
            fighter.element.childNodes[0].nextSibling.style.border = "none";
        });
    }

    _calculateFighterPercentage(standsFighter1, standsFighter2) {

        if (Math.abs(standsFighter1 - standsFighter2) < 10) {

            if (this.winPercent1 > this.winPercent2) {

                this.winPercent1 = [0, 0.59];
                this.winPercent2 = [0.6, 1.0];

            } else {

                this.winPercent1 = [0, 0.39];
                this.winPercent2 = [0.4, 1.0];
            }
        } else {

            if (this.winPercent1 > this.winPercent2) {

                this.winPercent1 = [0, 0.69];
                this.winPercent2 = [0.7, 1.0];

            } else {

                this.winPercent1 = [0, 0.29];
                this.winPercent2 = [0.3, 1.0];

            }
        }
    }

    _calculateWinner() {

        const x = this._random(0, 1);
        let winnerId = 0;
        let loserId = 1;

        if (x >= this.winPercent1[0] && x <= this.winPercent1[1]) {

            winnerId = 0;
            loserId = 1;

        } else {

            winnerId = 1;
            loserId = 0;
        }
        return {
            winner: winnerId,
            loser: loserId
        };
    }

    _random(min, max) {
        return Math.random() * (max - min) + min;
    }

    _postData(url, data) {
        fetch(url, {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                credentials: 'same-origin',
                referrerPolicy: 'no-referrer',
                redirect: 'follow',
                body: JSON.stringify(data)
            })
            .then(response => response.text())
            .then((response) => {
                console.log(response)
            })
            .catch(err => console.log(err))
    }
}