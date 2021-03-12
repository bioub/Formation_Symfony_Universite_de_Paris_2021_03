import { NgModule } from '@angular/core';
import { FourOhFourComponent } from './components/four-oh-four/four-oh-four.component';
import { SharedModule } from '../shared/shared.module';

@NgModule({
  declarations: [
    FourOhFourComponent
  ],
  imports: [
    SharedModule
  ],
  exports: [
    FourOhFourComponent
  ],
})
export class CoreModule {}
