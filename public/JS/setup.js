let Labels = [];
for (let h = 0; h < 24; h++) {
    Labels.push(h + ':00:00', h + ':15:00', h + ':30:00', h + ':45:00')
}

let datat = [];
for (let v = 0; v < 96; v++) {
    datat.push(4 + (Math.random() * 2))
}

let datah = [];
for (let v = 0; v < 96; v++) {
    datah.push(48 + (Math.random() * 2))
}


const TempData = {
    labels: Labels,
    datasets: [{
        label: 'Temp (°C)',
        backgroundColor: 'rgb(255, 0, 0)',
        borderColor: 'rgb(255, 0, 0)',
        data: datat,
    }]
}

const HygroData = {
    labels: Labels,
    datasets: [{
        label: 'Hygro (%)',
        backgroundColor: 'rgb(0, 0, 255)',
        borderColor: 'rgb(0, 0, 255)',
        data: datah,
    }]
}
