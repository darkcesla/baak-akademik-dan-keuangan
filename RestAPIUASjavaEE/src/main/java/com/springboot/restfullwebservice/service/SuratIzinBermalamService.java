package com.springboot.restfullwebservice.service;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.BookingRuangan;
import com.springboot.restfullwebservice.Enitity.SuratIzinBermalam;
import com.springboot.restfullwebservice.repository.SuratIzinBermalamRepository;

import java.time.LocalDateTime;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

@Service
public class SuratIzinBermalamService {
	
	  @Autowired
	    private SuratIzinBermalamRepository SuratIzinBermalamRepository;
	  
    public SuratIzinBermalam createSuratIzinBermalam(SuratIzinBermalam SuratIzinBermalam) {
        LocalDateTime Odate = SuratIzinBermalam.getWaktuBerangkat();
        LocalDateTime Cdate = SuratIzinBermalam.getWaktuKembali();

        if (Odate != null && Cdate != null && Odate.isBefore(Cdate)) {
        	SuratIzinBermalam.setStatus("Pending");
            return SuratIzinBermalamRepository.save(SuratIzinBermalam);
        } else {
            throw new IllegalArgumentException("Gagal Request Periksa Waktu Berangkat Dan Waktu Kembali Anda");
        }
        	

    }

    public List<SuratIzinBermalam> getAllSuratIzinBermalam() {
    	List<SuratIzinBermalam> SIB = SuratIzinBermalamRepository.findAll();
    	Comparator<SuratIzinBermalam> comparator = Comparator.comparing(SuratIzinBermalam::getWaktuBerangkat);
    	Collections.sort(SIB, comparator);
    	return SIB;

    }
    public List<SuratIzinBermalam> getSuratIzinBermalamByUser(Long userId) {
        return SuratIzinBermalamRepository.findByUserId(userId);
    }

    public SuratIzinBermalam getSuratIzinBermalamById(Long id) {
        return SuratIzinBermalamRepository.findById(id).orElse(null);
    }

    public void deleteSuratIzinBermalamById(Long id) {
        SuratIzinBermalamRepository.deleteById(id);
    }

    public SuratIzinBermalam updateSuratIzinBermalam(Long id, SuratIzinBermalam updatedSuratIzinBermalam) {
        SuratIzinBermalam existingSuratIzinBermalam = SuratIzinBermalamRepository.findById(id).orElse(null);

        if (existingSuratIzinBermalam != null) {
                existingSuratIzinBermalam.setKeterangan(updatedSuratIzinBermalam.getKeterangan());
                existingSuratIzinBermalam.setStatus(updatedSuratIzinBermalam.getStatus());
                existingSuratIzinBermalam.setWaktuBerangkat(updatedSuratIzinBermalam.getWaktuBerangkat());
                existingSuratIzinBermalam.setWaktuKembali(updatedSuratIzinBermalam.getWaktuKembali());
                existingSuratIzinBermalam.setTujuan(updatedSuratIzinBermalam.getTujuan());
                return SuratIzinBermalamRepository.save(existingSuratIzinBermalam);
            } 
        else {
            return null;
        }
     
    }
    public SuratIzinBermalam changeStatus(Long id, SuratIzinBermalam updatedSuratIzinBermalam) {
    	 SuratIzinBermalam existingSuratIzinBermalam = SuratIzinBermalamRepository.findById(id).orElse(null);

         if (existingSuratIzinBermalam != null) {
                 existingSuratIzinBermalam.setStatus(updatedSuratIzinBermalam.getStatus());
                 return SuratIzinBermalamRepository.save(existingSuratIzinBermalam);
             } 
         else {
             return null;
         }
    }
   
}
