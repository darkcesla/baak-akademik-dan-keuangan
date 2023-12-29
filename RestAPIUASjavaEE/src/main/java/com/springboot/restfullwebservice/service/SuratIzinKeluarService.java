package com.springboot.restfullwebservice.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.SuratIzinKeluar;
import com.springboot.restfullwebservice.repository.SuratIzinKeluarRepository;

import java.time.LocalDateTime;
import java.util.List;

@Service
public class SuratIzinKeluarService {
	
	  @Autowired
	    private SuratIzinKeluarRepository SuratIzinKeluarRepository;
	  
    public SuratIzinKeluar createSuratIzinKeluar(SuratIzinKeluar SuratIzinKeluar) {
        LocalDateTime Odate = SuratIzinKeluar.getWaktuBerangkat();
        LocalDateTime Cdate = SuratIzinKeluar.getWaktuKembali();

        if (Odate != null && Cdate != null && Odate.isBefore(Cdate)) {
        	SuratIzinKeluar.setStatus("Pending");
            return SuratIzinKeluarRepository.save(SuratIzinKeluar);
        } else {
            throw new IllegalArgumentException("Gagal Request Periksa Waktu Berangkat Dan Waktu Kembali Anda");
        }
        	

    }

    public List<SuratIzinKeluar> getAllSuratIzinKeluar() {
        return SuratIzinKeluarRepository.findAll();
    }
    public List<SuratIzinKeluar> getSuratIzinKeluarByUser(Long userId) {
        return SuratIzinKeluarRepository.findByUserId(userId);
    }

    public SuratIzinKeluar getSuratIzinKeluarById(Long id) {
        return SuratIzinKeluarRepository.findById(id).orElse(null);
    }

    public void deleteSuratIzinKeluarById(Long id) {
        SuratIzinKeluarRepository.deleteById(id);
    }

    public SuratIzinKeluar updateSuratIzinKeluar(Long id, SuratIzinKeluar updatedSuratIzinKeluar) {
        SuratIzinKeluar existingSuratIzinKeluar = SuratIzinKeluarRepository.findById(id).orElse(null);

        if (existingSuratIzinKeluar != null) {
                existingSuratIzinKeluar.setKeterangan(updatedSuratIzinKeluar.getKeterangan());
                existingSuratIzinKeluar.setStatus(updatedSuratIzinKeluar.getStatus());
                existingSuratIzinKeluar.setWaktuBerangkat(updatedSuratIzinKeluar.getWaktuBerangkat());
                existingSuratIzinKeluar.setWaktuKembali(updatedSuratIzinKeluar.getWaktuKembali());
                return SuratIzinKeluarRepository.save(existingSuratIzinKeluar);
            } 
        else {
            return null;
        }
     
    }
    public SuratIzinKeluar changeStatus(Long id, SuratIzinKeluar updatedSuratIzinKeluar) {
    	 SuratIzinKeluar existingSuratIzinKeluar = SuratIzinKeluarRepository.findById(id).orElse(null);

         if (existingSuratIzinKeluar != null) {
                 existingSuratIzinKeluar.setStatus(updatedSuratIzinKeluar.getStatus());
                 return SuratIzinKeluarRepository.save(existingSuratIzinKeluar);
             } 
         else {
             return null;
         }
    }
   
}
