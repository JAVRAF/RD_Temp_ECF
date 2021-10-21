let Labels = [];
for (let h = 0; h < 24; h++) {
    Labels.push(h + ':00:00', h + ':15:00', h + ':30:00', h + ':45:00')
}

const TempData = {
    labels: Labels,
    datasets: [{
        label: 'Temp (°C)',
        backgroundColor: 'rgb(255, 0, 0)',
        borderColor: 'rgb(255, 0, 0)',
        data: [5.12, 5.25, 5.09, 5.15, 5.20, 5.22, 5.19, 5.10],
    }]
}

const HygroData = {
    labels: Labels,
    datasets: [{
        label: 'Hygro (%)',
        backgroundColor: 'rgb(0, 0, 255)',
        borderColor: 'rgb(0, 0, 255)',
        data: [48, 50, 49, 49, 47, 48, 49, 51],
    }]
}
