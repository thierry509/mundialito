<template>
    <div>
        <template v-for="i in count">
            <singleMatchKnockout />
        </template>
    </div>
</template>
<script setup>
function getValue(count, n) {
    // Vérification des paramètres
    if (n < 1 || n > count) return undefined;

    // Définition des séquences
    const sequences = {
        8: [-346, -246, -146, -50, 50, 146, 246, 346],
        4: [-146, -50, 50, 146],
        2: [-50, 50]
    };

    // Retourne la valeur correspondante
    return sequences[count]?.[n - 1];
}


for (let i = 1; i <= count; i++) {

    let p = getValue(count, i);
    console.log(p, i)
    ctx.beginPath();
    ctx.moveTo(230, m - p);
    ctx.lineTo(330, m - p);
    ctx.closePath();
    ctx.stroke();


    ctx.beginPath();
    ctx.moveTo(330, m - p);
    if (i % 2 != 0) {
        ctx.lineTo(330, m - p - 50);
    }
    else {
        ctx.lineTo(330, m - p + 50);
    }
    ctx.closePath();
    ctx.stroke()

    ctx.beginPath()
    if (i % 2 != 0) {

        ctx.moveTo(330, m - p - 50);
        ctx.lineTo(430, m - p - 50);
    }
    ctx.closePath();
    ctx.stroke();

}
</script>
