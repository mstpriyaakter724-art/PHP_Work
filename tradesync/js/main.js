// =============================================
// TradeSync v2.0 – Fully Dynamic Dashboard JS
// =============================================

// ── MOCK DATA ENGINE (replaces PHP API for demo)
const DB = {
  kpis: {
    totalImport:   2847500,
    totalInventory: 14382,
    totalSales:    1563200,
    netProfit:      348940,
    openPOs: 23, activeLCs: 7, inTransit: 5,
    lowStock: 11, customers: 142, suppliers: 38
  },
  monthly: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    sales:  [210000,185000,235000,198000,272000,310000,289000,325000,298000,340000,315000,380000],
    import: [155000,140000,175000,160000,195000,228000,210000,235000,215000,248000,230000,275000],
    profit: [55000, 45000, 60000, 38000, 77000, 82000, 79000, 90000, 83000, 92000, 85000,105000]
  },
  quarterly: {
    labels:['Q1','Q2','Q3','Q4'],
    sales: [630000,780000,912000,1035000],
    import:[470000,583000,660000,753000],
    profit:[190000,197000,252000,282000]
  },
  categories: {
    labels:['Electronics','Textiles','Auto Parts','Plastics','Steel & Metal','Others'],
    data:  [38,22,17,9,8,6]
  },
  purchaseOrders: [
    {po:'PO-2024-0088',supplier:'Shenzhen Electronics',amount:84500,status:'Pending',date:'Jun 20'},
    {po:'PO-2024-0087',supplier:'Global Textiles Ltd', amount:31200,status:'Approved',date:'Jun 18'},
    {po:'PO-2024-0086',supplier:'Korea Auto Parts',    amount:120000,status:'Shipped',date:'Jun 15'},
    {po:'PO-2024-0085',supplier:'Vietnam Plastics Co', amount:22800,status:'Received',date:'Jun 12'},
    {po:'PO-2024-0084',supplier:'China Steel Corp',    amount:98400,status:'Received',date:'Jun 09'},
  ],
  shipments: [
    {no:'SHP-2024-0041',company:'Maersk Line',eta:'Jun 28',status:'in_transit'},
    {no:'SHP-2024-0040',company:'COSCO',      eta:'Jun 25',status:'customs'},
    {no:'SHP-2024-0039',company:'MSC',         eta:'Jun 20',status:'delivered'},
    {no:'SHP-2024-0038',company:'CMA CGM',     eta:'Jul 02',status:'in_transit'},
    {no:'SHP-2024-0037',company:'Evergreen',   eta:'Jun 30',status:'booked'},
  ],
  salesOrders: [
    {so:'SO-0312',customer:'Rahman Traders',  amount:12400,status:'Confirmed'},
    {so:'SO-0311',customer:'City Electronics',amount:8750, status:'Delivered'},
    {so:'SO-0310',customer:'BD Auto Imports', amount:34000,status:'Pending'},
    {so:'SO-0309',customer:'Star Garments Ltd',amount:5600,status:'Paid'},
    {so:'SO-0308',customer:'Metro Wholesale', amount:19800,status:'Confirmed'},
  ],
  lowStock: [
    {name:'Samsung 65W Adapter', pct:8,  qty:12,  level:'critical'},
    {name:'Cotton T-Shirt (M)',   pct:14, qty:21,  level:'critical'},
    {name:'PVC Pipe 2inch',       pct:25, qty:38,  level:'warning'},
    {name:'Auto Brake Pad Set',   pct:30, qty:45,  level:'warning'},
    {name:'Steel Rod 10mm',       pct:32, qty:50,  level:'warning'},
  ],
  activities: [
    {dot:'blue',  text:'GRN created for SHP-0041',      time:'2 mins ago'},
    {dot:'green', text:'Invoice INV-0891 paid',          time:'15 mins ago'},
    {dot:'orange',text:'PO-0088 approved by admin',      time:'1 hour ago'},
    {dot:'red',   text:'Low stock: Samsung Adapter',     time:'3 hours ago'},
    {dot:'blue',  text:'New customer: Star Garments Ltd',time:'5 hours ago'},
    {dot:'green', text:'SHP-0039 cleared customs',       time:'Yesterday'},
    {dot:'orange',text:'LC-0021 opened at HSBC Bank',    time:'Yesterday'},
    {dot:'blue',  text:'New supplier: Japan Electronics',time:'2 days ago'},
  ]
};

// ── CHART INSTANCES
let salesImportChart = null, categoryChart = null, profitChart = null;

// ── HELPERS
const $ = id => document.getElementById(id);
const fmt = n => '$' + Number(n).toLocaleString();
const isDark = () => document.body.classList.contains('dark-mode');

const gridColor  = () => isDark() ? 'rgba(255,255,255,0.07)' : 'rgba(0,0,0,0.06)';
const textColor  = () => isDark() ? '#94a3b8' : '#64748b';
const tooltipStyle = () => ({
  backgroundColor: isDark() ? '#1e293b' : '#fff',
  borderColor:     isDark() ? '#334155' : '#e2e8f0',
  borderWidth: 1,
  titleColor:  isDark() ? '#f1f5f9' : '#0f172a',
  bodyColor:   isDark() ? '#94a3b8' : '#64748b',
  padding: 12, cornerRadius: 8
});

// ── TOAST SYSTEM
function showToast(msg, type = 'info') {
  let container = document.querySelector('.ts-toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'ts-toast-container';
    document.body.appendChild(container);
  }
  const icons = {success:'bi-check-circle-fill', error:'bi-x-circle-fill', warning:'bi-exclamation-triangle-fill', info:'bi-info-circle-fill'};
  const toast = document.createElement('div');
  toast.className = `ts-toast ${type}`;
  toast.innerHTML = `<i class="bi ${icons[type]} ts-toast-icon"></i><span class="ts-toast-msg">${msg}</span><button class="ts-toast-close" onclick="this.parentElement.remove()">×</button>`;
  container.appendChild(toast);
  setTimeout(() => { toast.classList.add('hiding'); setTimeout(() => toast.remove(), 300); }, 4000);
}

// ── COUNTER ANIMATION
function animateCounter(el, target, prefix = '', suffix = '', duration = 1200) {
  if (!el) return;
  let start = 0, step = Math.ceil(target / (duration / 16));
  const timer = setInterval(() => {
    start = Math.min(start + step, target);
    el.textContent = prefix + start.toLocaleString() + suffix;
    if (start >= target) clearInterval(timer);
  }, 16);
}

// ── RENDER KPI CARDS
function renderKPIs(data) {
  const kpis = data || DB.kpis;
  animateCounter($('kpi-import'),   kpis.totalImport,   '$');
  animateCounter($('kpi-inventory'),kpis.totalInventory, '', ' units');
  animateCounter($('kpi-sales'),    kpis.totalSales,    '$');
  animateCounter($('kpi-profit'),   kpis.netProfit,     '$');
  if ($('mini-pos'))       $('mini-pos').textContent        = kpis.openPOs;
  if ($('mini-lcs'))       $('mini-lcs').textContent        = kpis.activeLCs;
  if ($('mini-transit'))   $('mini-transit').textContent    = kpis.inTransit;
  if ($('mini-lowstock'))  $('mini-lowstock').textContent   = kpis.lowStock;
  if ($('mini-customers')) $('mini-customers').textContent  = kpis.customers;
  if ($('mini-suppliers')) $('mini-suppliers').textContent  = kpis.suppliers;
}

// ── BUILD SALES/IMPORT CHART
function buildSalesImportChart(period = 'monthly') {
  const ctx = $('salesImportChart');
  if (!ctx) return;
  const d = DB[period] || DB.monthly;
  if (salesImportChart) salesImportChart.destroy();
  salesImportChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: d.labels,
      datasets: [
        { label:'Sales Revenue', data: d.sales,  backgroundColor:'rgba(26,86,219,0.82)', borderRadius:6, borderSkipped:false },
        { label:'Import Cost',   data: d.import, backgroundColor:'rgba(14,159,110,0.75)', borderRadius:6, borderSkipped:false }
      ]
    },
    options: {
      responsive:true, maintainAspectRatio:true,
      interaction:{ mode:'index', intersect:false },
      plugins:{
        legend:{ position:'top', align:'end', labels:{ boxWidth:12,boxHeight:12,borderRadius:3,useBorderRadius:true,padding:16,font:{size:12}, color: textColor() }},
        tooltip:{ ...tooltipStyle(), callbacks:{ label: ctx => ` ${ctx.dataset.label}: $${(ctx.raw/1000).toFixed(0)}K` }}
      },
      scales:{
        x:{ grid:{display:false}, ticks:{ font:{size:11}, color: textColor() }},
        y:{ grid:{color: gridColor()}, ticks:{ font:{size:11}, color: textColor(), callback: v => `$${(v/1000).toFixed(0)}K` }}
      }
    }
  });
}

// ── BUILD CATEGORY CHART
function buildCategoryChart() {
  const ctx = $('categoryChart');
  if (!ctx) return;
  if (categoryChart) categoryChart.destroy();
  categoryChart = new Chart(ctx, {
    type:'doughnut',
    data:{
      labels: DB.categories.labels,
      datasets:[{ data: DB.categories.data, backgroundColor:['#1a56db','#0e9f6e','#7c3aed','#d97706','#0694a2','#94a3b8'], borderWidth:0, hoverOffset:6 }]
    },
    options:{
      responsive:true, maintainAspectRatio:true, cutout:'68%',
      plugins:{
        legend:{ position:'bottom', labels:{ boxWidth:10,boxHeight:10,borderRadius:2,useBorderRadius:true,padding:10,font:{size:11}, color: textColor() }},
        tooltip:{ ...tooltipStyle(), callbacks:{ label: ctx => ` ${ctx.label}: ${ctx.raw}%` }}
      }
    }
  });
}

// ── BUILD PROFIT CHART
function buildProfitChart(period = 'monthly') {
  const ctx = $('profitChart');
  if (!ctx) return;
  const d = DB[period] || DB.monthly;
  if (profitChart) profitChart.destroy();
  profitChart = new Chart(ctx, {
    type:'line',
    data:{
      labels: d.labels,
      datasets:[{
        label:'Net Profit', data: d.profit,
        borderColor:'#1a56db',
        backgroundColor: (c) => {
          const g = c.chart.ctx.createLinearGradient(0,0,0,180);
          g.addColorStop(0,'rgba(26,86,219,0.22)'); g.addColorStop(1,'rgba(26,86,219,0)');
          return g;
        },
        borderWidth:2.5, pointRadius:4, pointBackgroundColor:'#1a56db',
        pointBorderColor:'#fff', pointBorderWidth:2, fill:true, tension:0.4
      }]
    },
    options:{
      responsive:true, maintainAspectRatio:true,
      plugins:{
        legend:{display:false},
        tooltip:{ ...tooltipStyle(), callbacks:{ label: ctx => ` Net Profit: $${(ctx.raw/1000).toFixed(1)}K` }}
      },
      scales:{
        x:{ grid:{display:false}, ticks:{ font:{size:11}, color: textColor() }},
        y:{ grid:{color: gridColor()}, ticks:{ font:{size:11}, color: textColor(), callback: v => `$${(v/1000).toFixed(0)}K` }}
      }
    }
  });
}

// ── RENDER PO TABLE
function renderPOTable(data) {
  const tbody = $('po-tbody');
  if (!tbody) return;
  const statusMap = { Pending:'badge-pending', Approved:'badge-approved', Shipped:'badge-shipped', Received:'badge-received', Cancelled:'badge-cancelled' };
  tbody.innerHTML = (data || DB.purchaseOrders).map(r => `
    <tr>
      <td><span class="mono">${r.po}</span></td>
      <td>${r.supplier}</td>
      <td><strong>${fmt(r.amount)}</strong></td>
      <td><span class="badge-ts ${statusMap[r.status]||'badge-pending'}">${r.status}</span></td>
      <td>${r.date}</td>
    </tr>`).join('');
}

// ── RENDER SHIPMENTS
function renderShipments(data) {
  const list = $('shipment-list');
  if (!list) return;
  const cfg = {
    in_transit:{ cls:'in-transit', icon:'bi-truck',        txt:'In Transit',  txtCls:'in-transit-txt' },
    customs:   { cls:'customs',    icon:'bi-shield-check',  txt:'At Customs',  txtCls:'customs-txt' },
    delivered: { cls:'delivered',  icon:'bi-check-circle',  txt:'Delivered',   txtCls:'delivered-txt' },
    booked:    { cls:'pending-ship',icon:'bi-clock-history',txt:'Booked',      txtCls:'pending-ship-txt' },
  };
  list.innerHTML = (data || DB.shipments).map(s => {
    const c = cfg[s.status] || cfg.booked;
    return `<div class="shipment-item">
      <div class="ship-icon ${c.cls}"><i class="bi ${c.icon}"></i></div>
      <div class="ship-body">
        <div class="ship-no">${s.no}</div>
        <div class="ship-company">${s.company} · ETA: ${s.eta}</div>
      </div>
      <div class="ship-status ${c.txtCls}">${c.txt}</div>
    </div>`;
  }).join('');
}

// ── RENDER SALES ORDERS
function renderSOTable(data) {
  const tbody = $('so-tbody');
  if (!tbody) return;
  const statusMap = { Confirmed:'badge-approved', Delivered:'badge-shipped', Pending:'badge-pending', Paid:'badge-received', Cancelled:'badge-cancelled' };
  tbody.innerHTML = (data || DB.salesOrders).map(r => `
    <tr>
      <td><span class="mono">${r.so}</span></td>
      <td>${r.customer}</td>
      <td><strong>${fmt(r.amount)}</strong></td>
      <td><span class="badge-ts ${statusMap[r.status]||'badge-pending'}">${r.status}</span></td>
    </tr>`).join('');
}

// ── RENDER LOW STOCK
function renderLowStock(data) {
  const list = $('stock-list');
  if (!list) return;
  list.innerHTML = (data || DB.lowStock).map(s => `
    <div class="stock-item">
      <div class="stock-name">
        <span>${s.name}</span>
        <span class="stock-qty ${s.level==='critical'?'text-danger':'text-warning'}">${s.qty} left</span>
      </div>
      <div class="stock-bar-wrap"><div class="stock-bar ${s.level==='warning'?'warning-bar':''}" style="width:${s.pct}%"></div></div>
    </div>`).join('');
}

// ── RENDER ACTIVITIES
function renderActivities(data) {
  const feed = $('activity-feed');
  if (!feed) return;
  feed.innerHTML = (data || DB.activities).map(a => `
    <div class="activity-item">
      <div class="act-dot dot-${a.dot}"></div>
      <div class="act-body">
        <div class="act-text">${a.text}</div>
        <div class="act-time">${a.time}</div>
      </div>
    </div>`).join('');
}

// ── UPDATE LAST REFRESHED LABEL
function updateLastRefreshed() {
  const el = $('last-refreshed');
  if (el) el.textContent = 'Updated ' + new Date().toLocaleTimeString();
}

// ── SIMULATE LIVE DATA REFRESH (fluctuate values slightly)
function refreshData() {
  const fluctuate = (v, pct=0.03) => Math.round(v * (1 + (Math.random()-0.5)*pct));
  DB.kpis.totalSales    = fluctuate(DB.kpis.totalSales);
  DB.kpis.totalImport   = fluctuate(DB.kpis.totalImport);
  DB.kpis.netProfit     = fluctuate(DB.kpis.netProfit);
  DB.kpis.totalInventory = fluctuate(DB.kpis.totalInventory, 0.01);
  // Shuffle last monthly value slightly
  const last = DB.monthly.sales.length - 1;
  DB.monthly.sales[last]  = fluctuate(DB.monthly.sales[last]);
  DB.monthly.import[last] = fluctuate(DB.monthly.import[last]);
  DB.monthly.profit[last] = fluctuate(DB.monthly.profit[last]);
  renderKPIs();
  buildSalesImportChart(currentPeriod);
  buildProfitChart(currentPeriod);
  updateLastRefreshed();
  showToast('Dashboard data refreshed', 'success');
}

// ── REBUILD CHARTS ON THEME CHANGE (colours need updating)
function rebuildAllCharts() {
  buildSalesImportChart(currentPeriod);
  buildCategoryChart();
  buildProfitChart(currentPeriod);
}

// ── PERIOD STATE
let currentPeriod = 'monthly';

// ══════════════════════════════════════
// INIT
// ══════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {

  // ── Date
  const dateEl = $('currentDate');
  if (dateEl) {
    dateEl.textContent = new Date().toLocaleDateString('en-US', { weekday:'short', year:'numeric', month:'short', day:'numeric' });
  }

  // ── Dynamic greeting
  const greetEl = $('greeting');
  if (greetEl) {
    const h = new Date().getHours();
    greetEl.textContent = h < 12 ? 'Good Morning' : h < 17 ? 'Good Afternoon' : 'Good Evening';
  }

  // ── Sidebar toggle
  const toggle = $('sidebarToggle');
  if (toggle) {
    toggle.addEventListener('click', () => {
      if (window.innerWidth > 992) document.body.classList.toggle('sidebar-collapsed');
      else document.body.classList.toggle('sidebar-open');
    });
    document.addEventListener('click', e => {
      if (window.innerWidth <= 992 && document.body.classList.contains('sidebar-open'))
        if (!e.target.closest('.sidebar') && !e.target.closest('#sidebarToggle'))
          document.body.classList.remove('sidebar-open');
    });
  }

  // ── Dark mode
  const themeBtn = $('themeToggle');
  const saved = localStorage.getItem('ts-theme');
  if (saved === 'dark') { document.body.classList.add('dark-mode'); if (themeBtn) themeBtn.innerHTML = '<i class="bi bi-sun"></i>'; }
  if (themeBtn) {
    themeBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      const dark = document.body.classList.contains('dark-mode');
      localStorage.setItem('ts-theme', dark ? 'dark' : 'light');
      themeBtn.innerHTML = dark ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon-stars"></i>';
      setTimeout(rebuildAllCharts, 50);
    });
  }

  // ── Sidebar search
  const sSearch = document.querySelector('.sidebar-search input');
  if (sSearch) {
    sSearch.addEventListener('input', function() {
      const q = this.value.toLowerCase();
      document.querySelectorAll('.nav-item').forEach(item => {
        const t = item.querySelector('span')?.textContent.toLowerCase() || '';
        item.style.display = t.includes(q) ? '' : 'none';
      });
    });
  }

  // ── Chart period toggle
  document.querySelectorAll('.chart-btn[data-period]').forEach(btn => {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.chart-btn[data-period]').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      currentPeriod = this.dataset.period;
      buildSalesImportChart(currentPeriod);
      buildProfitChart(currentPeriod);
    });
  });

  // ── Manual refresh button
  const refreshBtn = $('refreshBtn');
  if (refreshBtn) {
    refreshBtn.addEventListener('click', () => {
      const icon = refreshBtn.querySelector('i');
      if (icon) { icon.classList.add('spin-anim'); setTimeout(() => icon.classList.remove('spin-anim'), 600); }
      refreshData();
    });
  }

  // ── Chart.js global defaults
  Chart.defaults.font.family = "'Inter', sans-serif";

  // ── Initial render
  renderKPIs();
  renderPOTable();
  renderShipments();
  renderSOTable();
  renderLowStock();
  renderActivities();
  updateLastRefreshed();
  setTimeout(() => {
    buildSalesImportChart('monthly');
    buildCategoryChart();
    buildProfitChart('monthly');
  }, 100);

  // ── Auto-refresh every 30 seconds (silently)
  setInterval(() => {
    const fluctuate = (v, p=0.02) => Math.round(v * (1+(Math.random()-.5)*p));
    DB.kpis.totalSales  = fluctuate(DB.kpis.totalSales);
    DB.kpis.netProfit   = fluctuate(DB.kpis.netProfit);
    renderKPIs();
    updateLastRefreshed();
  }, 30000);

  // ── Welcome greeting
  showToast('Dashboard loaded successfully', 'success');
});
