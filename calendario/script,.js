class VibeCalendar {
    constructor() {
        this.currentDate = new Date();
        this.selectedDate = new Date();
        this.events = JSON.parse(localStorage.getItem('calendarEvents')) || {};
        
        this.init();
    }
    
    init() {
        this.renderCalendar();
        this.bindEvents();
        this.renderEvents();
    }
    
    renderCalendar() {
        const monthYear = document.getElementById('current-month');
        const daysContainer = document.getElementById('calendar-days');
        
        // Atualizar cabeçalho
        const monthNames = [
            'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
            'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
        ];
        
        monthYear.textContent = `${monthNames[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;
        
        // Limpar dias
        daysContainer.innerHTML = '';
        
        // Primeiro dia do mês
        const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
        // Último dia do mês
        const lastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0);
        // Dia da semana do primeiro dia (0 = Domingo, 6 = Sábado)
        const firstDayIndex = firstDay.getDay();
        
        // Dias do mês anterior
        const prevMonthLastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 0).getDate();
        
        // Adicionar dias do mês anterior
        for (let i = firstDayIndex; i > 0; i--) {
            const dayElement = document.createElement('div');
            dayElement.className = 'day other-month';
            dayElement.textContent = prevMonthLastDay - i + 1;
            daysContainer.appendChild(dayElement);
        }
        
        // Adicionar dias do mês atual
        for (let i = 1; i <= lastDay.getDate(); i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'day';
            dayElement.textContent = i;
            
            const dateKey = this.getDateKey(new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), i));
            
            // Verificar se é hoje
            const today = new Date();
            if (this.currentDate.getMonth() === today.getMonth() && 
                this.currentDate.getFullYear() === today.getFullYear() && 
                i === today.getDate()) {
                dayElement.classList.add('today');
            }
            
            // Verificar se tem eventos
            if (this.events[dateKey] && this.events[dateKey].length > 0) {
                dayElement.classList.add('has-event');
            }
            
            // Evento de clique
            dayElement.addEventListener('click', () => {
                this.selectDate(new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), i));
            });
            
            daysContainer.appendChild(dayElement);
        }
        
        // Adicionar dias do próximo mês para completar a grid
        const totalCells = 42; // 6 semanas * 7 dias
        const remainingCells = totalCells - (firstDayIndex + lastDay.getDate());
        
        for (let i = 1; i <= remainingCells; i++) {
            const dayElement = document.createElement('div');
            dayElement.className = 'day other-month';
            dayElement.textContent = i;
            daysContainer.appendChild(dayElement);
        }
    }
    
    bindEvents() {
        document.getElementById('prev-month').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
            this.renderCalendar();
        });
        
        document.getElementById('next-month').addEventListener('click', () => {
            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
            this.renderCalendar();
        });
        
        document.getElementById('add-event-btn').addEventListener('click', () => {
            this.addEvent();
        });
        
        document.getElementById('event-input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                this.addEvent();
            }
        });
    }
    
    selectDate(date) {
        this.selectedDate = date;
        this.renderEvents();
    }
    
    addEvent() {
        const eventInput = document.getElementById('event-input');
        const eventText = eventInput.value.trim();
        
        if (eventText === '') return;
        
        const dateKey = this.getDateKey(this.selectedDate);
        
        if (!this.events[dateKey]) {
            this.events[dateKey] = [];
        }
        
        this.events[dateKey].push({
            id: Date.now(),
            text: eventText
        });
        
        // Salvar no localStorage
        localStorage.setItem('calendarEvents', JSON.stringify(this.events));
        
        // Atualizar interface
        this.renderEvents();
        this.renderCalendar();
        
        // Limpar input
        eventInput.value = '';
    }
    
    removeEvent(dateKey, eventId) {
        if (this.events[dateKey]) {
            this.events[dateKey] = this.events[dateKey].filter(event => event.id !== eventId);
            
            if (this.events[dateKey].length === 0) {
                delete this.events[dateKey];
            }
            
            // Salvar no localStorage
            localStorage.setItem('calendarEvents', JSON.stringify(this.events));
            
            // Atualizar interface
            this.renderEvents();
            this.renderCalendar();
        }
    }
    
    renderEvents() {
        const eventsList = document.getElementById('events-list');
        const dateKey = this.getDateKey(this.selectedDate);
        
        eventsList.innerHTML = '';
        
        if (this.events[dateKey] && this.events[dateKey].length > 0) {
            this.events[dateKey].forEach(event => {
                const eventElement = document.createElement('div');
                eventElement.className = 'event-item';
                eventElement.innerHTML = `
                    <span>${event.text}</span>
                    <button onclick="calendar.removeEvent('${dateKey}', ${event.id})">×</button>
                `;
                eventsList.appendChild(eventElement);
            });
        } else {
            eventsList.innerHTML = '<p style="color: #7f8c8d; text-align: center;">Nenhum evento para este dia</p>';
        }
    }
    
    getDateKey(date) {
        return `${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`;
    }
}

// Inicializar o calendário quando a página carregar
const calendar = new VibeCalendar();