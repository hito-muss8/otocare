/* Aset, data layanan, dan state booking */
const LOGO = "assets/logo.png", BR = h => `<img class="lg" src="${LOGO}" alt="OtoCare" style="height:${h}px">`;
const rp = n => (n < 0 ? "-" : "") + "Rp" + Math.abs(n).toLocaleString("id-ID"), $ = s => document.getElementById(s);

const VEH = [["Honda Vario 160 CBS", "AB 1234 CD", "Motor Matic", "Hitam Metalik", "18 Okt 2024"], ["Toyota Avanza 1.5 G", "B 1234 CD", "Mobil SUV / MPV", "Silver Metalik", "12 Okt 2024"], ["Honda Civic RS Turbo", "D 5678 EFG", "Mobil Sedan", "Putih Mutiara", "28 Sep 2024"]];
const SV = [["Cuci Komplit + Hydrophobic Wax", 50000, "45 Menit", "Terlaris", ["Cuci bodi busa salju pH netral", "Pembersihan sasis & area swingarm", "Semir ban matte & velg degreasing"]], ["Cuci Eksterior Reguler", 30000, "30 Menit", "", ["Snow wash pH-netral", "Bilas air filtrasi murni", "Semir ban & lap microfiber"]], ["Detailing Kilap & Body Coating", 120000, "75 Menit", "Premium", ["Polish 1-step swirl remover", "Pembersihan kerak sela mesin", "Nano ceramic sealant 3 bulan"]]];
const AD = [["Fogging Anti-Bakteri & Helm Care", 15000], ["Dressing Rantai & Silikon Kabel", 10000]];
const DAYS = [["Hari Ini", 24], ["Besok", 25], ["Sabtu", 26], ["Minggu", 27], ["Senin", 28]], TM = ["08.30", "09.30", "10.30", "11.00", "13.00", "14.30", "15.00", "16.00", "16.30", "17.00"], FULL = ["08.30", "11.00", "17.00"];
const S = { v: 0, s: 0, ad: [1], d: 0, t: "14.30", p: 1, cp: 1, pay: 0, bank: 0, ch: 0 };
let step = 1, T = 1, G = 0;
const tot = () => SV[S.s][1] + S.ad.reduce((a, i) => a + AD[i][1], 0) + (S.p ? 10000 : 0) - (S.cp ? 10000 : 0);

const ICON_USER = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 4-6 8-6s8 2 8 6"/></svg>`;
