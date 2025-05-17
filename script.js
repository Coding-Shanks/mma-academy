// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Three.js animation for hero section
    const container = document.getElementById('threejs-container');
    if (container) {
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        container.appendChild(renderer.domElement);

        const geometry = new THREE.TorusKnotGeometry(10, 3, 100, 16);
        const material = new THREE.MeshBasicMaterial({ color: 0xe53e3e, wireframe: true });
        const torusKnot = new THREE.Mesh(geometry, material);
        scene.add(torusKnot);

        camera.position.z = 30;

        function animate() {
            requestAnimationFrame(animate);
            torusKnot.rotation.x += 0.01;
            torusKnot.rotation.y += 0.01;
            renderer.render(scene, camera);
        }
        animate();

        // Resize handler
        window.addEventListener('resize', () => {
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        });
    }

    // Program filtering
    const skillFilter = document.getElementById('skill-filter');
    const typeFilter = document.getElementById('type-filter');
    const programList = document.getElementById('program-list');

    if (skillFilter && typeFilter && programList) {
        const programs = programList.getElementsByClassName('card');

        function filterPrograms() {
            const skill = skillFilter.value;
            const type = typeFilter.value;

            Array.from(programs).forEach(program => {
                const skillMatch = skill === 'all' || program.dataset.skill === skill;
                const typeMatch = type === 'all' || program.dataset.type === type;
                program.style.display = skillMatch && typeMatch ? 'block' : 'none';
            });
        }

        skillFilter.addEventListener('change', filterPrograms);
        typeFilter.addEventListener('change', filterPrograms);
    }
});