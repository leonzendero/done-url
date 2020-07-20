
let Data = [];

function clear() {
    Data = [];
    start();
}

function shows() {
    let view = '';
    Data.forEach((item) => {
        view += `ID: ${item.id} Name: ${item.name} Status: ${item.status} \n`;
    });

    alert(view);
}

function delete_t() {
    let dell = +prompt('id:');

    let redata = [];
    Data.forEach((item) => {
        if (item.id != dell) {
            redata.push(item);
        }
    });

    Data = redata;
}

function add() {
    let name = prompt('Name:');
    let status = prompt('Status:');

    let id = parseInt(Math.random() * 1000);

    Data.push({
        id: id,
        name: name,
        status: status
    });
}

function edit() {
    let edit = +prompt('id:');

    let name = prompt('Name:');
    let status = prompt('Status:');

    Data.forEach((item, key) => {
        if (item.id == edit){
            Data[key].name = name;
            Data[key].status = status;
        }
    });
}

function start() {

    while(true) {
        let menu = +prompt(`
            1 - shows
            2 - add
            3 - edit
            4 - delete
            5 - clear
            6 - exit 
        `);
        switch (menu) {
            case 1:
                shows();
                break;
            case 2:
                add();
                break;
            case 3:
                edit();
                break;
            case 4:
                delete_t();
                break;
            case 5:
                clear();
                break;
            default:
                alert('number 1 - 6');
        }

        if ( menu == 6 ) {
            break;
        }
    }
}

start();