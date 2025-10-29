// Funções para modais de produtos
function openProductModal() {
    document.getElementById('productModal').classList.add('active');
    document.getElementById('modalTitle').textContent = 'Novo Produto';
    document.getElementById('formAction').value = 'create';
    document.querySelector('#productModal form').reset();
}

function closeProductModal() {
    document.getElementById('productModal').classList.remove('active');
}

function editProduct(product) {
    document.getElementById('productModal').classList.add('active');
    document.getElementById('modalTitle').textContent = 'Editar Produto';
    document.getElementById('formAction').value = 'update';
    document.getElementById('productId').value = product.id;
    document.getElementById('nome').value = product.nome;
    document.getElementById('descricao').value = product.descricao;
    document.getElementById('preco').value = product.preco;
    document.getElementById('estoque').value = product.estoque;
    document.getElementById('categoria').value = product.categoria;
    document.getElementById('imagem').value = product.imagem;
    document.getElementById('ativo').checked = product.ativo == 1;
}

// Funções para modais de usuários
function openUserModal() {
    document.getElementById('userModal').classList.add('active');
}

function closeUserModal() {
    document.getElementById('userModal').classList.remove('active');
}

function editUser(user) {
    document.getElementById('userModal').classList.add('active');
    document.getElementById('userId').value = user.id;
    document.getElementById('userName').value = user.nome;
    document.getElementById('userEmail').value = user.email;
    document.getElementById('userTipo').value = user.tipo;
}

// Função para ver detalhes do pedido
function viewOrder(orderId) {
    alert('Funcionalidade de visualização de pedido #' + orderId + ' será implementada');
}

// Fechar modal ao clicar fora
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.classList.remove('active');
        }
    });
}

// Gráficos (Chart.js) - Dashboard Admin
if (typeof salesData !== 'undefined' && salesData) {
    createSalesChart();
}

if (typeof productsData !== 'undefined' && productsData) {
    createProductsChart();
}

function createSalesChart() {
    const ctx = document.getElementById('salesChart');
    if (!ctx) return;

    // Criar gráfico de linha simples com JavaScript puro
    const canvas = ctx.getContext('2d');
    const data = salesData.map(item => parseFloat(item.total_vendas));
    const labels = salesData.map(item => {
        const date = new Date(item.data);
        return date.getDate() + '/' + (date.getMonth() + 1);
    });

    drawLineChart(canvas, data, labels, 'Vendas (R$)');
}

function createProductsChart() {
    const ctx = document.getElementById('productsChart');
    if (!ctx) return;

    // Criar gráfico de barras simples com JavaScript puro
    const canvas = ctx.getContext('2d');
    const data = productsData.map(item => parseInt(item.vendas));
    const labels = productsData.map(item => item.nome.substring(0, 20));

    drawBarChart(canvas, data, labels, 'Vendas');
}

// Desenhar gráfico de linha simples
function drawLineChart(ctx, data, labels, title) {
    const canvas = ctx.canvas;
    const width = canvas.width;
    const height = canvas.height;
    const padding = 50;
    const chartWidth = width - padding * 2;
    const chartHeight = height - padding * 2;

    const maxValue = Math.max(...data);
    const step = chartHeight / maxValue;

    // Limpar canvas
    ctx.clearRect(0, 0, width, height);

    // Desenhar eixos
    ctx.strokeStyle = '#cbd5e1';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, height - padding);
    ctx.lineTo(width - padding, height - padding);
    ctx.stroke();

    // Desenhar linhas da grade
    ctx.strokeStyle = '#e2e8f0';
    ctx.lineWidth = 1;
    for (let i = 0; i <= 5; i++) {
        const y = padding + (chartHeight / 5) * i;
        ctx.beginPath();
        ctx.moveTo(padding, y);
        ctx.lineTo(width - padding, y);
        ctx.stroke();
    }

    // Desenhar linha de dados
    ctx.strokeStyle = '#2563eb';
    ctx.lineWidth = 3;
    ctx.beginPath();
    
    const stepX = chartWidth / (data.length - 1);
    
    data.forEach((value, index) => {
        const x = padding + stepX * index;
        const y = height - padding - value * step;
        
        if (index === 0) {
            ctx.moveTo(x, y);
        } else {
            ctx.lineTo(x, y);
        }
    });
    
    ctx.stroke();

    // Desenhar pontos
    ctx.fillStyle = '#2563eb';
    data.forEach((value, index) => {
        const x = padding + stepX * index;
        const y = height - padding - value * step;
        
        ctx.beginPath();
        ctx.arc(x, y, 4, 0, Math.PI * 2);
        ctx.fill();
    });

    // Desenhar labels
    ctx.fillStyle = '#64748b';
    ctx.font = '12px Arial';
    ctx.textAlign = 'center';
    
    labels.forEach((label, index) => {
        const x = padding + stepX * index;
        ctx.fillText(label, x, height - padding + 20);
    });
}

// Desenhar gráfico de barras simples
function drawBarChart(ctx, data, labels, title) {
    const canvas = ctx.canvas;
    const width = canvas.width;
    const height = canvas.height;
    const padding = 50;
    const chartWidth = width - padding * 2;
    const chartHeight = height - padding * 2;

    const maxValue = Math.max(...data);
    const barWidth = chartWidth / data.length - 10;

    // Limpar canvas
    ctx.clearRect(0, 0, width, height);

    // Desenhar eixos
    ctx.strokeStyle = '#cbd5e1';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, height - padding);
    ctx.lineTo(width - padding, height - padding);
    ctx.stroke();

    // Desenhar barras
    const colors = ['#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6'];
    
    data.forEach((value, index) => {
        const barHeight = (value / maxValue) * chartHeight;
        const x = padding + (barWidth + 10) * index + 10;
        const y = height - padding - barHeight;

        ctx.fillStyle = colors[index % colors.length];
        ctx.fillRect(x, y, barWidth, barHeight);

        // Valor acima da barra
        ctx.fillStyle = '#1e293b';
        ctx.font = 'bold 14px Arial';
        ctx.textAlign = 'center';
        ctx.fillText(value, x + barWidth / 2, y - 5);
    });

    // Desenhar labels
    ctx.fillStyle = '#64748b';
    ctx.font = '11px Arial';
    ctx.textAlign = 'center';
    
    labels.forEach((label, index) => {
        const x = padding + (barWidth + 10) * index + 10 + barWidth / 2;
        ctx.save();
        ctx.translate(x, height - padding + 10);
        ctx.rotate(-Math.PI / 4);
        ctx.fillText(label, 0, 0);
        ctx.restore();
    });
}

// Confirmação antes de deletar
document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Tem certeza que deseja realizar esta ação?')) {
            e.preventDefault();
        }
    });
});

// Auto-submit de forms de quantidade no carrinho
document.querySelectorAll('.quantity-form input[type="number"]').forEach(input => {
    input.addEventListener('change', function() {
        this.form.submit();
    });
});

// Animações suaves ao scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Feedback visual ao adicionar ao carrinho
document.querySelectorAll('form[action*="carrinho"]').forEach(form => {
    form.addEventListener('submit', function() {
        const button = this.querySelector('button[type="submit"]');
        if (button) {
            const originalText = button.textContent;
            button.textContent = '✓ Adicionado!';
            button.style.background = '#10b981';
            
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '';
            }, 2000);
        }
    });
});

// Validação de formulários
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = '#ef4444';
            } else {
                field.style.borderColor = '';
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios.');
        }
    });
});

// Loading state para forms
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        const submitButton = this.querySelector('button[type="submit"]');
        if (submitButton && !submitButton.disabled) {
            submitButton.disabled = true;
            submitButton.style.opacity = '0.6';
            submitButton.style.cursor = 'not-allowed';
        }
    });
});

console.log('MiniLoja - Sistema carregado com sucesso! ✓');
