const rooms = [
    { id: "D10.172", name: "Ruang Workshop", image: "/img/workshop2.jpg" },
    { id: "D10.176", name: "Lab Sains Data & Multimedia", image: "/img/lab sains data.jpg" },
    { id: "D10.178", name: "Ruang Microteaching", image: "/img/Microteaching.jpg" },
    { id: "D10.286", name: "Smart Classroom", image: "/img/Smartclass.jpg" },
    { id: "D10.289", name: "Ruang Seminar", image: "/img/Seminar.jpg" },
    { id: "D10.373", name: "Lab Komputer 1", image: "/img/lab1.jpg" },
    { id: "D10.370A", name: "Lab Komputer 2", image: "/img/Lab programming.jpg" },
    { id: "D10.370B", name: "Lab Jaringan", image: "/img/lab_jaringan.jpg" },
  ];
  
  const grid = document.getElementById("roomGrid");
  rooms.forEach(room => {
    grid.innerHTML += `
      <div class="col-md-4 mb-4">
        <div class="card room-card h-100">
          <img src="${room.image}" class="card-img-top" alt="${room.name}" />
          <div class="card-body">
            <h5 class="card-title">${room.name}</h5>
            <p class="card-text">Kode Ruangan: ${room.id}</p>
            <a href="/detail-ruangan?id=${room.id}" class="btn btn-primary">Lihat Detail</a>
          </div>
        </div>
      </div>`;
  });
  