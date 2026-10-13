/* Aksi pengguna dan router hash */
function st(d) { if (step === 5 && d > 0) {
  location.hash = "#/bayar";
  return;
} step = Math.max(1, Math.min(5, step + d)); H(); scrollTo(0, 0); }
function ad(i) { const k = S.ad.indexOf(i); k < 0 ? S.ad.push(i) : S.ad.splice(k, 1); H(); }
function rate(n) { document.querySelectorAll("#st span").forEach((e, i) => e.style.opacity = i < n ? 1 : .3); }
function H() { const r = location.hash.slice(1) || "/"; $("app").innerHTML = (pages[r] || pages["/"])(); const s = document.getElementById("st"); s && rate(5); }
addEventListener("hashchange", () => { scrollTo(0, 0); H(); });
H();
